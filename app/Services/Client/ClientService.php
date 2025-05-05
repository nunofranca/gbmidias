<?php
namespace App\Services\Client;


use App\Repositories\Client\ClientRepositoryInterface;


class ClientService implements ClientServiceInterface
{
    public function __construct(protected ClientRepositoryInterface $clientRepository)
    {
        
    }

    public function firstOrCreate($payloadComparation, $payloadInsert)
    {
        return $this->clientRepository->firstOrCreate($payloadComparation, $payloadInsert);
    }

    public function createAsk($client, $ask, $askId)
    {
        return $this->clientRepository->createAsk($client, $ask, $askId);
    }

    public function getByPhone($payload) 
    {
        return $this->clientRepository->getByPhone($payload); 
    }
}