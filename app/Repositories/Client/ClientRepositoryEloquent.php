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
        $client->ask()->create([
            'ask' => $ask,
            'askId' => $askId 
        ]);
    }
}