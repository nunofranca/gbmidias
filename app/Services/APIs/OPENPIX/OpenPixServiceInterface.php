<?php
namespace App\Services\APIs\OPENPIX;

interface OpenPixServiceInterface
{
    public function charge($payload);
}