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

    public function index()
    {
      return $this->model->chuck(50);
    }
}