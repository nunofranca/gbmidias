<?php
namespace App\Services\Sale;


use App\Repositories\Sale\SaleRepositoryInterface;
use App\Services\Service\ServiceServiceInterface;


class SaleService implements SaleServiceInterface
{
    public function __construct(
        protected SaleRepositoryInterface $saleRepository,
        protected ServiceServiceInterface $serviceService,
    )
    {

    }


    public function create($payload)
    {
        $service = $this->serviceService->getById($payload['service_id']);

        $payload['totalValue'] = ($service->rate/1000) * $payload['quantity'];
        $payload['valueUnity'] = $service->rate;


        return $this->saleRepository->create($payload);
    }
}
