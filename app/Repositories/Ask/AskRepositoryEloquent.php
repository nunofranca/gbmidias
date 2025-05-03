<?php

namespace App\Repositories\Ask;

use App\Repositories\BaseRepository;

use App\Models\Ask;


class AskRepositoryEloquent extends BaseRepository implements AskRepositoryInterface
{
    public function __construct(Ask $ask)
    {
        parent::__construct($ask);
    }
}