<?php
namespace App\Services\Service;


use App\Models\Service;
use App\Models\User;

interface ServiceServiceInterface
{
    public function index();

    public function getByCategory($category);

    public function getById($id);

    public function modifyRateWithPercent(Service $service, string $percent);
}
