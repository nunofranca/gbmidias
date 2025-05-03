<?php

namespace App\Repositories\Response;

use App\Models\Response;
use App\Repositories\BaseRepository;


class ResponseRespositoryEloquent extends BaseRepository implements ResponseRepositoryInterface
{

    public function __construct(Response $response)
    {
        parent::__construct($response);
    }
}