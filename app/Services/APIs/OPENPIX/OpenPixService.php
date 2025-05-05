<?php

namespace App\Services\APIs\OPENPIX;


use App\Repositories\APIs\OPENPIX\OpenPixRepositoryInterface;

class OpenPixService implements OpenPixServiceInterface
{

    public function __construct(protected OpenPixRepositoryInterface $openPixRepository)
    {
        
    }


    public function charge($payload)
    {
        return $this->openPixRepository->charge($payload);
    }

    
}