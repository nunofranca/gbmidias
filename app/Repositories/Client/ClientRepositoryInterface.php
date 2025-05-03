<?php

namespace App\Repositories\Client;


interface ClientRepositoryInterface
{
    public function firstOrCreate($payloadComparation, $payloadInsert);

    public function createAsk($client, $ask, $askId);
}