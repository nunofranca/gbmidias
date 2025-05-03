<?php
namespace App\Services\Response;


use App\Repositories\Response\ResponseRepositoryInterface;


class ResponseService implements ResponseServiceInterface
{
    public function __construct(protected ResponseRepositoryInterface $responseRepository)
    {
        
    }


    public function create(array $payload)
    {
        return $this->responseRepository->create($payload);
    }
}