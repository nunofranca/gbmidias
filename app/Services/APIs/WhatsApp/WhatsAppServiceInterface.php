<?php

namespace App\Services\APIs\WhatsApp;


interface WhatsAppServiceInterface
{
    public function sendText($payload);

    public function sendButtonAction($payload);
}