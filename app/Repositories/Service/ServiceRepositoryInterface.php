<?php

namespace App\Repositories\Service;

use App\Models\User;

interface ServiceRepositoryInterface
{
    public function index();
    public function getByCategory($category);
    public function getById($id);

    public function update($id, $payload);
    public function modifyRateWithPercent($user, $id, $payload);

}
