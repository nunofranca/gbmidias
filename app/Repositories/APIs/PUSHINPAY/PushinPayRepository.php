<?php
namespace App\Repositories\APIs\PUSHINPAY;
use Illuminate\Support\Facades\Http;

class PushinPayRepository implements PushinPayRepositoryInterface
{
    public function charge($payload)
    {
        return Http::upmidias()->post('pix/cashIn', $payload)->json();
    }
}