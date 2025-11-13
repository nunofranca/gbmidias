<?php

namespace App\Services\Service;


use App\Models\Service;
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

    public function modifyRateWithPercent(Service $service, string $percent)
    {


        $coast = (int) Str::remove(['.', ' ', ','], $service->coast);
        $rate = (int) Str::remove(['.', ' ', ','], $service->rate);

        if(Auth::user()->hasRole('SUPER')){
            $payload = [
                'rate' =>  (int)round(($coast * $percent)/100)+$coast,
            ];
        }
        if(Auth::user()->hasRole('ADMIN')){
            $payload = [
                'rate' =>  (int)round(($rate * $percent)/100)+$rate,
            ];
        }




        return $this->serviceRepository->update($service->id, $payload);
    }


}
