<?php

namespace App\Services\APIs\GPT;

use App\Models\Client;
interface GptServiceInterface
{
    public function createThread();

    public function setMessageInTread(Client $client, string $message);

    public function getMessagesOfTread(Client $client);

    public function runAssistant(Client $client);

    public function transcribeAudio(array $payload);
}