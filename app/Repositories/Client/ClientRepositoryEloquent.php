<?php

namespace App\Repositories\Client;

use App\Models\Client;

use App\Repositories\BaseRepository;


class ClientRepositoryEloquent extends BaseRepository implements ClientRepositoryInterface
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function createAsk($client, $ask, $askId)
    {
        return $client->asks()->create([
            'ask' => $ask,
            'askId' => $askId 
        ]);
    }

    public function getByPhone($payload)
    {
        return $this->model->getByPhone($payload)->first(); 
    }
}