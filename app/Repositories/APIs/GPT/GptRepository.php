<?php
namespace App\Repositories\APIs\GPT;

use Illuminate\Support\Facades\Http;

use App\Models\User;

class GptRepository implements GptRepositoryInterface
{
    public function createThread()
    {
        return Http::gpt()->post('/threads')->json();
    }

    public function setMessageInTread(User $user, string $message)
    {
        Http::gpt()->post('/threads/'.$user->treadId.'/messages', [
            'role' => 'user',
            'content' => $message,
        ])->json();

    }

    public function getMessagesOfTread(User $user)
    {
        $message = Http::gpt()
            ->get('/threads/'.$user->treadId.'/messages')
            ->json();

        return $message['data'][0]['content'][0]['text']['value'] ?? 'Desculpa, estamos com uma instabilidade no momento. Volte em instante';
    }

    public function runAssistant(User $user)
    {
        return Http::gpt()->post('/threads/'.$user->treadId.'/runs', [
            'assistant_id' => 'asst_9zWXuGeAnlsVBghkAoY8JMik',
            
        ])->json();

    }

    public function getStatusRun(User $user, $runAssistant)
    {
        return Http::gpt()
            ->get('/threads/'.$user->treadId.'/runs/'.$runAssistant['id'])
            ->json();

    }

    public function runTool(User $user, array $runStatus, array $functionCallId, $result)
    {
        Http::gpt()->post('/threads/'.$user->treadId.'/runs/'.$runStatus['id'].'/submit_tool_outputs', [
            'tool_outputs' => [
                [
                    'tool_call_id' => $functionCallId['id'],
                    'output' => json_encode(['status' => $result]),
                ],
            ],
        ])->json();
    }


    public function transcribeAudio($filename)
    {
        return Http::gpt()->attach('file', fopen($filename, 'r'), 'audio.ogg')
            ->post('/audio/transcriptions', [
                'model' => 'whisper-1',
            ]);
    }
}