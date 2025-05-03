<?php

namespace App\Repositories\APIs\GPT;

use App\Models\Client;

interface GptRepositoryInterface
{
    public function createThread();

    public function setMessageInTread(Client $client, string $message);

    public function getMessagesOfTread(Client $client);

    public function runAssistant(Client $client);

    public function runTool(Client $client, array $runStatus, array $functionCallId, $result);

    public function getStatusRun(Client $client, $runAssistant);

    public function transcribeAudio($filename);
}