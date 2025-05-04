<?php

namespace App\Services\APIs\GPT;

use App\Models\Client;
use App\Repositories\APIs\GPT\GptRepositoryInterface;
use App\Services\APIs\WhatsApp\WhatsAppServiceInterface;
use App\Services\Sale\SaleServiceInterface;
use App\Services\Service\ServiceServiceInterface;

use Illuminate\Support\Str;

class GptService implements GptServiceInterface
{

        public function __construct(
            protected GptRepositoryInterface $gptRepository,
            protected WhatsAppServiceInterface $whatsAppService,
            protected ServiceServiceInterface $serviceService,
            protected SaleServiceInterface $saleService
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
    
        $maxTries = 5;
        $tries = 0;
    
        do {
            sleep(1);
            $runStatus = $this->gptRepository->getStatusRun($client, $runAssistant);
            $tries++;
    
            if ($runStatus['status'] === 'requires_action') {
                \Log::info('Status requires_action. Executando função...');
                $this->handleFunctionCall($client, $runStatus, $runAssistant);
    
                // Após executar a função, você precisa reiniciar o run!
                $runAssistant = $this->gptRepository->runAssistant($client);
                \Log::info('Assistente reiniciado.');
                continue;
            }
    
        } while (in_array($runStatus['status'], ['queued', 'in_progress', 'requires_action']) && $tries < $maxTries);
        \Log::info('Execução finalizada após ' . $tries . ' tentativas.');
    }
    
    

   private function handleFunctionCall(Client $client, array $runStatus, array $runAssistant)
    {

        $functionCall = $runStatus['required_action']['submit_tool_outputs']['tool_calls'][0];

        $functionName = $functionCall['function']['name'];
        $arguments = json_decode($functionCall['function']['arguments'], true);


        switch ($functionName) {
            case 'get_services':
                $this->getServices($client, $runStatus, $functionCall, $arguments);
                break;
            case 'create_order_service':
                $this->createOrderService($client, $runStatus, $functionCall, $arguments);
                break;
        }

        do {
            sleep(2);
            $runStatus = $this->gptRepository->getStatusRun($client, $runAssistant);

        } while ($runStatus['status'] === 'in_progress');

    }


    private function getServices($client, $runStatus, $functionCall, $arguments)
    {
       

      
        $allServices  = $this->serviceService->getByCategory(Str::lower($arguments['category']));
        
       

       $this->gptRepository->runTool($client, $runStatus, $functionCall, $allServices);
       
    

    }


    private function createOrderService($client, $runStatus, $functionCall, $arguments)
    {
  
        
            $sale = $this->saleService->create([
                'client_id' => $client->id,
                'totalValue' =>  $arguments['totalValue'],
                'link' => $arguments['link'],

            ]);


            collect($arguments['services'])->map(function($service) use($sale){                

                $sale->services()->attach($service['service_id'], [
                    'quantity' => $service['quantity'],
                    'valueUnity' => $service['valueUnity'],
                ]);
            });

            sleep(1);
           

            //$transaction = $sale->transaction()->create($transaction['charge']);

           return $this->gptRepository->runTool($client, $runStatus, $functionCall,  'Sucessso ao realizar o pedido. Faça o pagamento para confirmar a inscrição.');

           // $this->whatsAppService->sendButtonAction(['phone' => $user->phone, 'paymentLinkUrl' => $transaction->paymentLinkUrl]);
        
       
    }  


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