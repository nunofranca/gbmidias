<?php
namespace App\Repositories\Sale;

use App\Models\Sale;
use App\Repositories\BaseRepository;


class SaleRepositoryEloquent extends BaseRepository implements SaleRepositoryInterface
{

    public function __construct(Sale $sale)
    {
        parent::__construct($sale);
    }
}