<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\WhatsApp\WebHookRequest;
use App\Models\Transaction;
use App\Services\APIs\GPT\GptServiceInterface;
use App\Services\APIs\WhatsApp\WhatsAppService;
use App\Services\Ask\AskServiceInterface;
use App\Services\Client\ClientServiceInterface;
use App\Services\Response\ResponseServiceInterface;
use Illuminate\Support\Facades\Http;
use App\Enum\StatusPaymentEnum;

class WebHooksController extends Controller
{

    public function __construct(
        protected ClientServiceInterface $clientService,
        protected GptServiceInterface $gptService,
        protected AskServiceInterface $askService,
        protected ResponseServiceInterface $responseService,
        protected WhatsAppService $whatsAppService,
        )
    {
        
    }

    public function validateWebHook(Request $request)
    {
    
        $verifyToken = 'gbmidias_token';
        $payload = $request->all();
        $mode = $payload['hub_mode'];
        $token = $payload['hub_verify_token'];
        $challenge = $payload['hub_challenge'];

        if ($mode === 'subscribe' && $token === $verifyToken) {
            return $challenge;
        }

        return response('Token inválido ou erro na validação.', 403);
    }

    public function webhook(WebHookRequest $request)
    {
        $payload = $request->validated();

        if (isset($payload['status']) || in_array($payload['message']['type'], ['document'])) {
            return response($payload, 200);
        }

    
        $client = $this->clientService->firstOrCreate(
            ['phone' => $payload['message']['from']],
            [
                'name' => $payload['contact']['profile']['name'],
            ]
        );

        if (!$client->threadId) {
            $thread = Http::gpt()
                ->post('/threads')
                ->json();

            if (! isset($thread['id'])) {
                throw new \Exception('Falha ao criar thread: '.json_encode($thread));
            }
            $client->update(['threadId' => $thread['id']]);
            $client->refresh();
        }

        match ($payload['message']['type']) {
            'text' => $this->handleText($payload['message']['text']['body'], $payload['message']['id'], $client),
           // 'audio' => $this->transcribeAudio($payload['message'], $user),
            
        };

    }

    public function webhookZApi(Request $request)
    {
        $payload = $request->all();

        if ($payload['isGroup'] || !isset($payload['text'])) {
            return response($payload, 200);
        }

    
        $client = $this->clientService->firstOrCreate(
            ['phone' => $payload['phone']],
            [
                'name' => $payload['senderName'] ??  $payload['chatName'],
            ]
        );

        if (!$client->threadId) {
            $thread = Http::gpt()
                ->post('/threads')
                ->json();

            if (! isset($thread['id'])) {
                throw new \Exception('Falha ao criar thread: '.json_encode($thread));
            }
            $client->update(['threadId' => $thread['id']]);
            $client->refresh();
        }
        if(!isset($payload['text'])); return response($payload, 200);
        

            $this->handleText($payload['text']['message'], $payload['messageId'], $client);
           // 'audio' => $this->transcribeAudio($payload['message'], $user),
      

    }

    private function handleText($ask, $askId, $client)
    {
        $ask = $this->clientService->createAsk($client, $ask, $askId);
       

        $this->gptService->setMessageInTread($client, $ask->ask);

        $this->gptService->runAssistant($client);

        $gptResponse = $this->gptService->getMessagesOfTread($client);

   
      $this->askService->saveResponse($ask, $gptResponse);

        $this->whatsAppService->sendText(['phone' => $client->phone, 'text' =>  $gptResponse]);
    }

   /*  private function handleAudio($ask, $askId, $user)
    {

        $response = $this->gptServiceInterface->transcribeAudio($ask);

        $this->handleText( $response['text'], $askId, $user);
    } */


    public function webHookOpenPix(Request $request)
    {    
        

    
        $payload = $request->all();

        if($payload['charge']['status'] !==  'COMPLETED') return;

        $transaction = Transaction::where('correlationID', $payload['charge']['correlationID'])->first();

        $transaction->update(['status' => StatusPaymentEnum::PAID]);

        $this->whatsAppService->sendText(['phone' => $transaction->sale->client->phone, 'text' => "Obrigado\n\nSeu pagamento foi confirmado. Fique atento ao seu whatsapp para, pois vamos te manter atualizado a respeito do evento"]);

    
    }

    public function webHookPushinPay(Request $request)
    {    
 
    
        $payload = $request->all();

        if($payload['status'] !==  'paid') return;

        $transaction = Transaction::where('correlationID', $payload['id'])->first();

        $transaction->update(['status' => StatusPaymentEnum::PAID]);

        $this->whatsAppService->sendText(['phone' => $transaction->sale->client->phone, 'text' => "Obrigado\n\nSeu pagamento foi confirmado. Fique atento ao seu whatsapp para, pois vamos te manter atualizado a respeito do evento"]);
        

    
    }
}
