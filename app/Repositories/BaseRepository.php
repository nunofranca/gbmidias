<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function __construct(protected Model $model)
    {
        
    }


    public function index()
    {
      return $this->model->index();
    }


    public function firstOrCreate($payloadComparation, $payloadInsert)
    {
      return $this->model->firstOrCreate($payloadComparation, $payloadInsert);
    }

    public function create($payload)
    {
      return $this->model->create($payload);
    }
}