<?php

namespace App\Repositories\APIs\OPENPIX;

use Illuminate\Support\Facades\Http;

class OpenPixRepository implements OpenPixRepositoryInterface
{

    public function charge($payload)
    {
        return Http::openpix()->post('/charge', $payload)->json();
    }
}