<?php

namespace App\Repositories\Response;


interface ResponseRepositoryInterface
{
    public function create(array $payload);
}