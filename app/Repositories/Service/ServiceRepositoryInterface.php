<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function index();
    public function getByCategory($category);
    public function getById($id);

    public function update($id, $payload);

}
