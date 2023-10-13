<?php

namespace App\Repositories;

use App\Models\Laporans;
use App\Repositories\BaseRepository;

class LaporansRepository extends BaseRepository
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}