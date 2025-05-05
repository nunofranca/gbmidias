<?php

namespace App\Services\APIs\GPT;

use App\Models\Client;
use App\Repositories\APIs\GPT\GptRepositoryInterface;
use App\Services\APIs\OPENPIX\OpenPixService;
use App\Services\APIs\WhatsApp\WhatsAppServiceInterface;
use App\Services\Sale\SaleServiceInterface;
use App\Services\Service\ServiceServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\APIs\OPENPIX\OpenPixServiceInterface;

class GptService implements GptServiceInterface
{

        public function __construct(
            protected GptRepositoryInterface $gptRepository,
            protected WhatsAppServiceInterface $whatsAppService,
            protected ServiceServiceInterface $serviceService,
            protected SaleServiceInterface $saleService,
            protected OpenPixServiceInterface $openPixService,
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
                
                $this->handleFunctionCall($client, $runStatus, $runAssistant);
    
                // Após executar a função, você precisa reiniciar o run!
                $runAssistant = $this->gptRepository->runAssistant($client);
                break;
            }
    
        } while (in_array($runStatus['status'], ['queued', 'in_progress', 'requires_action']) && $tries < $maxTries);
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
            case 'resume_sale':
                $this->resumeSale($client, $runStatus, $functionCall, $arguments);
                break;
        }

        do {
            sleep(2);
            $runStatus = $this->gptRepository->getStatusRun($client, $runAssistant);

        } while ($runStatus['status'] === 'in_progress');
       

    }

    private function resumeSale($client, $runStatus, $functionCall, $arguments)
    {
       
        

        $service  = $this->serviceService->getById($arguments['service_id']);

        $resume = [
            'totalValue' => (Str::remove(['.', ','], $arguments['totalValue']) + ($service->rate / 1000) * $arguments['quantity'])/100,
        ];

        
        $this->gptRepository->runTool($client, $runStatus, $functionCall, 'Resume do pedido');

       $this->gptRepository->runTool($client, $runStatus, $functionCall, $resume);
       
    

    }


    private function getServices($client, $runStatus, $functionCall, $arguments)
    {
       

      
        $allServices  = $this->serviceService->getByCategory(Str::lower($arguments['category']));
        
        $this->gptRepository->runTool($client, $runStatus, $functionCall, 'Serviços encontrados');

       $this->gptRepository->runTool($client, $runStatus, $functionCall, $allServices);
       
    

    }


    private function createOrderService($client, $runStatus, $functionCall, $arguments)
    {
  
        
            $sale = $this->saleService->create([
                'client_id' => $client->id,
                'totalValue' =>  Str::remove(['.', ','], $arguments['totalValue']),
                'link' => $arguments['link'],

            ]);


            collect($arguments['services'])->map(function($service) use($sale){                

                $sale->services()->attach($service['service_id'], [
                    'quantity' => $service['quantity'],
                    'valueUnity' => $service['valueUnity'],
                ]);
            });

            $transaction = $this->openPixService->charge([
                'correlationID' => Str::random('16'),
                'value' => Str::remove(['.', ' ', '-'], $sale->totalValue),
                'comment' => $sale->service[0]->name,
            ]);

            $transaction = $sale->transaction()->create($transaction['charge']);

            $this->gptRepository->runTool($client, $runStatus, $functionCall,  'Sucessso ao realizar o pedido. Faça o pagamento para confirmar a inscrição.');

            $this->whatsAppService->sendButtonAction(['phone' => $client->phone, 'paymentLinkUrl' => $transaction->paymentLinkUrl]);
          
       
               
       
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