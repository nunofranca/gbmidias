<?php

namespace App\Services\APIs\WhatsApp;


interface WhatsAppServiceInterface
{
    public function sendText($payload);
}