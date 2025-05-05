<?php

namespace App\Services\APIs\PUSHINPAY;


interface PushinPayServiceInterface
{
    public function charge($payload);
}