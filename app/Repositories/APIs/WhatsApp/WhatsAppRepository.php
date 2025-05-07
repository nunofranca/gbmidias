<?php

namespace App\Repositories\APIs\WhatsApp;

use Illuminate\Support\Facades\Http;

class WhatsAppRepository implements WhatsRepositoryInterface
{
    public function sendText($payload)
    {

      

        return Http::withHeaders([
           'Client-Token'=>'F9f0bb229461741138e059f32973b9250S'
        ])->post('  https://api.z-api.io/instances/3E0D7020CFD3D0904E98DABA2DE1C2A1/token/78771D12CC9AD33B890394B8/send-text', [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $payload['phone'],
            'type' => 'text',
            'text' => [
                'body' => $payload['text'] ?? 'erro',
            ]
        ]);


       return Http::whatsapp()->post('/messages', [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $payload['phone'],
            'type' => 'text',
            'text' => [
                'body' => $payload['text'] ?? 'erro',
            ]
        ]);
    }
    public function sendButtonAction($payload)
    {
        return Http::whatsapp()->post('/messages', [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $payload['phone'],
            'type' => 'interactive',
            'interactive' => [
                'type' => 'cta_url',
                'header' => ['type' => 'text', 'text' => 'Pedido Realizado com sucesso'],
                'body' => ['text' => 'Clique no botão abaixo para pagar o pedido'],
                'footer' => ['text' => 'OTIMIZAP'],
                'action' => [
                    'name' => 'cta_url',
                    'parameters' => [
                        'display_text' => 'FAZER PAGAMENTO',
                        'url' => $payload['paymentLinkUrl'],
                    ],

                ],
            ],
        ]);
    }
}