<?php

namespace App\Services\Service;


use App\Models\Service;
use App\Models\User;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;

class ServiceService implements ServiceServiceInterface
{
    public function __construct(protected ServiceRepositoryInterface $serviceRepository)
    {

    }

    public function index()
    {
        return $this->serviceRepository->index();
    }

    public function getByCategory($category)
    {
        return $this->serviceRepository->getByCategory($category);
    }

    public function getById($id)
    {
        return $this->serviceRepository->getById($id);
    }

    public function modifyRateWithPercent(User $user, Service $service, string $percent)
    {


        $coast = (int) Str::remove(['.', ' ', ','], $service->coast);
        $rate = (int) Str::remove(['.', ' ', ','], $service->rate);



            $payload = [
                'rate' =>  (int)round(($coast * $percent)/100),
            ];





        return $this->serviceRepository->modifyRateWithPercent($user, $service->id, $payload);
    }


}
