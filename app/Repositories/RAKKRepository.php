<?php

namespace App\Repositories;

use App\Models\RAKK;
use App\Repositories\BaseRepository;

class RAKKRepository extends BaseRepository
{
    public function __construct(RAKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}