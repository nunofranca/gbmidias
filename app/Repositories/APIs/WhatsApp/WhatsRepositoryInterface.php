<?php

namespace App\Repositories\APIs\WhatsApp;


interface WhatsRepositoryInterface
{
    public function sendText($payload);
    public function sendButtonAction($payload);
}