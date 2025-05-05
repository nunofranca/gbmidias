<?php

namespace App\Services\APIs\PUSHINPAY;


use App\Repositories\APIs\PUSHINPAY\PushinPayRepositoryInterface;


class PushinPayService implements PushinPayServiceInterface
{
    public function __construct(protected PushinPayRepositoryInterface $pushinPayRepository)
    {
        
    }

    public function charge($payload)
    {
        return $this->pushinPayRepository->charge($payload);
    }
}