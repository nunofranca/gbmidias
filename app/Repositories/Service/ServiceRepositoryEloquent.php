<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Repositories\BaseRepository;


class ServiceRepositoryEloquent extends BaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $service)
    {
        parent::__construct($service);
    }


    public function getByCategory($category)
    {
        return $this->model->inRandomOrder()->limit(10)->where('category', $category)->get();
    }

   
}