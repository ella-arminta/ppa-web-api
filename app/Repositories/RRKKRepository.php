<?php

namespace App\Repositories;

use App\Models\RRKK;
use App\Repositories\BaseRepository;

class RRKKRepository extends BaseRepository
{
    public function __construct(RRKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}