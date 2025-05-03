<?php

namespace App\Services\APIs\GPT;


interface GptServiceInterface
{
    public function createThread();

    public function setMessageInTread(User $user, string $message);

    public function getMessagesOfTread(User $user);

    public function runAssistant(User $user);

    public function transcribeAudio(array $payload);
}