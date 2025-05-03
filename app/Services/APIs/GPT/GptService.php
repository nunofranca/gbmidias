<?php

namespace App\Services\APIs\GPT;

class GptService implements GptServiceInterface
{
    
    public function createThread()
    {
        return $this->gptRepository->createThread();
    }

    public function setMessageInTread(User $user, string $message)
    {
        return $this->gptRepository->setMessageInTread($user, $message);
    }

    public function getMessagesOfTread(User $user)
    {
        return $this->gptRepository->getMessagesOfTread($user);
    }

    public function runAssistant(User $user)
    {
        $runAssistant = $this->gptRepository->runAssistant($user);

        do {
            sleep(2);
            $runStatus = $this->gptRepository->getStatusRun($user, $runAssistant);


            if($runStatus['status'] === 'requires_action'){
                $this->handleFunctionCall($user, $runStatus, $runAssistant);
            
                break;
            }

    

        } while (in_array($runStatus['status'], ['queued', 'in_progress']));

    }

    private function handleFunctionCall(User $user, array $runStatus, array $runAssistant)
    {

        $functionCall = $runStatus['required_action']['submit_tool_outputs']['tool_calls'][0];

        $functionName = $functionCall['function']['name'];
        $arguments = json_decode($functionCall['function']['arguments'], true);


        match($functionName){
        
             'get_courses'=> $this->getCourses($user, $runStatus, $functionCall),
             'create_course_order' => $this->createCourseOrder($user, $runStatus, $functionCall, $arguments),
        };
            

        do {
            sleep(2);
            $runStatus = $this->gptRepository->getStatusRun($user, $runAssistant);

        } while ($runStatus['status'] === 'in_progress');

    }


    private function getCourses($user, $runStatus, $functionCall)
    {
        $courses = $this->courseService->index();
        
        $this->runTool($user, $runStatus, $functionCall, $courses);
        
    }

    private function createCourseOrder($user, $runStatus, $functionCall, $arguments)
    {
  
            $user->update(['name' => $arguments['student_name']]);

            $sale = $this->saleService->create([
                'user_id' => $user->id,
                'status' => false,
                'value' =>  $arguments['total_amount'],
                'paymentMethod' => $arguments['payment_method'],

            ]);


            collect($arguments['courses'])->map(function($course) use($sale){
                $course = Course::where('name', $course['course_name'])->first();
                $sale->courses()->attach($course->id);
            });


           

            $transaction = $this->openPixService->charge([
                'correlationID' => Str::random('16'),
                'value' => Str::remove(['.', ' ', '-'], $sale->value),
                'comment' => 'WorkShop - Aprenda a construir sistema para venda rápida',
            ]);

            $transaction = $sale->transaction()->create($transaction['charge']);

            $this->runTool($user, $runStatus, $functionCall,  'Sucessso ao realizar o pedido. Faça o pagamento para confirmar a inscrição.');

            $this->whatsAppService->sendButtonAction(['phone' => $user->phone, 'paymentLinkUrl' => $transaction->paymentLinkUrl]);
            sleep(5);
       
    } 


    private function runTool(User $user, array $runStatus, array $functionCallId, $result)
    {
        return $this->gptRepository->runTool($user, $runStatus, $functionCallId, $result);
    }


    public function transcribeAudio(array $payload)
    {       

        $audioResponse = $this->whatsAppService->downloadMedia($payload['audio']['id']);      

        $filename = storage_path('app/temp_audio.ogg');
        file_put_contents($filename, $audioResponse->body()); 

        return $this->gptRepository->transcribeAudio($filename);        
       
    
    }
}