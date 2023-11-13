<?php

namespace App\Repositories;

use App\Models\DetailKasus;
use App\Repositories\BaseRepository;

class DetailKasusRepository extends BaseRepository
{
    public function __construct(DetailKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}