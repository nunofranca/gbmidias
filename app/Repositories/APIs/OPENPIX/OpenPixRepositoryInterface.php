<?php
namespace App\Repositories\APIs\OPENPIX;


interface OpenPixRepositoryInterface
{
    public function charge($payload);
}