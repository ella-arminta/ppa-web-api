<?php

namespace App\Repositories;

use App\Models\Kronologis;
use App\Repositories\BaseRepository;

class KronologisRepository extends BaseRepository
{
    public function __construct(Kronologis $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}