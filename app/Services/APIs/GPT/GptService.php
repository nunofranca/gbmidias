<?php

namespace App\Services\APIs\GPT;

use App\Models\Client;
use App\Repositories\APIs\GPT\GptRepositoryInterface;
use App\Services\APIs\WhatsApp\WhatsAppServiceInterface;
use App\Services\Service\ServiceServiceInterface;
use Illuminate\Support\Str;

class GptService implements GptServiceInterface
{

        public function __construct(
            protected GptRepositoryInterface $gptRepository,
            protected WhatsAppServiceInterface $whatsAppService,
            protected ServiceServiceInterface $serviceService
            )
        {
            
        }

    
    public function createThread()
    {
        return $this->gptRepository->createThread();
    }

    public function setMessageInTread(Client $client, string $message)
    {
        return $this->gptRepository->setMessageInTread($client, $message);
    }

    public function getMessagesOfTread(Client $client)
    {
        return $this->gptRepository->getMessagesOfTread($client);
    }

    public function runAssistant(Client $client)
    {
        $runAssistant = $this->gptRepository->runAssistant($client);

        do {
            sleep(2);
            $runStatus = $this->gptRepository->getStatusRun($client, $runAssistant);


            if($runStatus['status'] === 'requires_action'){
                $this->handleFunctionCall($client, $runStatus, $runAssistant);
            
                break;
            } 

    

        } while (in_array($runStatus['status'], ['queued', 'in_progress']));

    }

   private function handleFunctionCall(Client $client, array $runStatus, array $runAssistant)
    {

        $functionCall = $runStatus['required_action']['submit_tool_outputs']['tool_calls'][0];

        $functionName = $functionCall['function']['name'];
        $arguments = json_decode($functionCall['function']['arguments'], true);


        match($functionName){
        
             'get_services'=> $services =$this->getServices($client, $runStatus, $functionCall, $arguments),
             //'create_course_order' => $this->createCourseOrder($client, $runStatus, $functionCall, $arguments),
        };
            

        do {
            sleep(2);
            $runStatus = $this->gptRepository->getStatusRun($client, $runAssistant);

        } while ($runStatus['status'] === 'in_progress');

    }


    private function getServices($client, $runStatus, $functionCall, $arguments)
    {
        $services = $this->serviceService->getByCategory(Str::lower($arguments['category']));

        $this->gptRepository->runTool($client, $runStatus, $functionCall, ['seguidores mundiais', 'seguidores nacionais']);
  
        
    }

    /*private function createCourseOrder($user, $runStatus, $functionCall, $arguments)
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
       
    }  */


   /*  private function runTool(Client $client, array $runStatus, array $functionCallId, $result)
    {
        return $this->gptRepository->runTool($client, $runStatus, $functionCallId, $result);
    }


    public function transcribeAudio(array $payload)
    {       

        $audioResponse = $this->whatsAppService->downloadMedia($payload['audio']['id']);      

        $filename = storage_path('app/temp_audio.ogg');
        file_put_contents($filename, $audioResponse->body()); 

        return $this->gptRepository->transcribeAudio($filename);        
       
    
    } */
}