<?php

namespace App\Repositories\APIs\WhatsApp;

use Illuminate\Support\Facades\Http;

class WhatsAppRepository implements WhatsRepositoryInterface
{
    public function sendText($payload)
    {
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
}