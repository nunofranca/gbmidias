<?php
namespace App\Services\Sale;


use App\Repositories\Sale\SaleRepositoryInterface;


class SaleService implements SaleServiceInterface
{
    public function __construct(protected SaleRepositoryInterface $saleRepository)
    {
        
    }


    public function create($payload)
    {
        return $this->saleRepository->create($payload);
    }
}