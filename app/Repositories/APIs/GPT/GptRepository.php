<?php
namespace App\Repositories\APIs\GPT;

use Illuminate\Support\Facades\Http;

use App\Models\Client;

class GptRepository implements GptRepositoryInterface
{
    public function createThread()
    {
        return Http::gpt()->post('/threads')->json();
    }

    public function setMessageInTread(Client $client, string $message)
    {
        Http::gpt()->post('/threads/'.$client->threadId.'/messages', [
            'role' => 'user',
            'content' => $message,
        ])->json();

    }

    public function getMessagesOfTread(Client $client)
    {
        $message = Http::gpt()
            ->get('/threads/'.$client->threadId.'/messages')
            ->json();

        return $message['data'][0]['content'][0]['text']['value'] ?? 'Desculpa, estamos com uma instabilidade no momento. Volte em instante';
    }

    public function runAssistant(Client $client)
    {
        return Http::gpt()->post('/threads/'.$client->threadId.'/runs', [
            'assistant_id' => 'asst_9zWXuGeAnlsVBghkAoY8JMik',
            
        ])->json();

    }

    public function getStatusRun(Client $client, $runAssistant)
    {
        return Http::gpt()
            ->get('/threads/'.$client->threadId.'/runs/'.$runAssistant['id'])
            ->json();

    }

   /*  public function runTool(Client $client, array $runStatus, array $functionCallId, $result)
    {
        Http::gpt()->post('/threads/'.$client->threadId.'/runs/'.$runStatus['id'].'/submit_tool_outputs', [
            'tool_outputs' => [
                [
                    'tool_call_id' => $functionCallId['id'],
                    'output' => json_encode(['status' => $result]),
                ],
            ],
        ])->json();
    }
 */

    /* public function transcribeAudio($filename)
    {
        return Http::gpt()->attach('file', fopen($filename, 'r'), 'audio.ogg')
            ->post('/audio/transcriptions', [
                'model' => 'whisper-1',
            ]);
    } */
}