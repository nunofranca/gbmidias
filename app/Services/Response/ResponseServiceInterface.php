<?php
namespace App\Services\Response;


interface ResponseServiceInterface
{
    public function create(array $payload);
}