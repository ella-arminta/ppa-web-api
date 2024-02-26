<?php

namespace App\Repositories;

use App\Models\Wilayah;
use App\Repositories\BaseRepository;

class WilayahRepository extends BaseRepository
{
    public function __construct(Wilayah $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}