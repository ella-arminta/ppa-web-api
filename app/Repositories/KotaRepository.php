<?php

namespace App\Repositories;

use App\Models\Kota;
use App\Repositories\BaseRepository;

class KotaRepository extends BaseRepository
{
    public function __construct(Kota $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}