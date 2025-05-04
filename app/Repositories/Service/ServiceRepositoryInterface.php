<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function index();
    public function getByCategory($category);
}