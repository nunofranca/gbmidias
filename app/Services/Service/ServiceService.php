<?php
namespace App\Services\Service;


use App\Repositories\Service\ServiceRepositoryInterface;
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
}