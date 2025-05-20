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
      return $this->model->get();
    }


    public function firstOrCreate($payloadComparation, $payloadInsert)
    {
      return $this->model->firstOrCreate($payloadComparation, $payloadInsert);
    }

    public function create($payload)
    {
      return $this->model->create($payload);
    }

    public function getById($id)
    {
      return $this->model->find($id);
    }

    public function update($id, $payload)
    {
        $model = $this->model->find($id);

        $model->update($payload);
    }
}
