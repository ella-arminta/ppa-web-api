<?php

namespace App\Repositories;

use App\Models\Penjadwalan;
use App\Repositories\BaseRepository;

class PenjadwalanRepository extends BaseRepository
{
    public function __construct(Penjadwalan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}