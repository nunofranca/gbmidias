<?php

namespace App\Services\APIs\WhatsApp;

use App\Repositories\APIs\WhatsApp\WhatsRepositoryInterface;
class WhatsAppService implements WhatsAppServiceInterface
{
    public function __construct(protected WhatsRepositoryInterface $whatsRepository)
    {
    
    }

    public function sendText($payload)
    {
        return $this->whatsRepository->sendText($payload);
    }



    public function sendButtonAction($payload)
    {
        return $this->whatsRepository->sendButtonAction($payload);
    }
}