<?php
namespace App\Services\Client;


interface ClientServiceInterface
{
    public function firstOrCreate($payloadComparation, $payloadInsert);

    public function createAsk($client, $ask, $askId);
}