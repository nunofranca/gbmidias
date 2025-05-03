<?php

namespace App\Repositories\APIs\GPT;

use App\Models\User;

interface GptRepositoryInterface
{
    public function createThread();

    public function setMessageInTread(User $user, string $message);

    public function getMessagesOfTread(User $user);

    public function runAssistant(User $user);

    public function runTool(User $user, array $runStatus, array $functionCallId, $result);

    public function getStatusRun(User $user, $runAssistant);

    public function transcribeAudio($filename);
}