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
        return $this->model->select(['id', 'name', 'rate', 'min'])
        ->inRandomOrder()->limit(5)->where('category', $category)->get();
    }


    public function getById($id)
    {
      return $this->model->where('id', $id)->orWhere('name', $id)->first();
    }

   
}