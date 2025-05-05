<?php
namespace App\Repositories\APIs\PUSHINPAY;

interface PushinPayRepositoryInterface
{
    public function charge($payload);
}