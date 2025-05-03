<?php

namespace App\Services\Ask;

use App\Models\Ask;
interface AskServiceInterface
{
    public function create(array $payload);


    public function saveResponse(Ask $ask, string $response);
}