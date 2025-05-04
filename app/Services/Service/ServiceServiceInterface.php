<?php
namespace App\Services\Service;


interface ServiceServiceInterface
{
    public function index();

    public function getByCategory($category);

    public function getById($id);
}