<?php
namespace App\Services\Ask;


use App\Repositories\Ask\AskRepositoryInterface;

use App\Models\Ask;

class AskService implements AskServiceInterface
{
    public function __construct(protected AskRepositoryInterface $askRepository)
    {
        
    }

    public function create(array $payload)
    {
        return $this->askRepository->create($payload);
    }
    public function saveResponse(Ask $ask, string $response)
    {
        $ask->response()->create([
            'response' => $response
        ]);
    }
}