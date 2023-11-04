<?php

namespace App\Repositories;

use App\Models\DetailKlien;
use App\Repositories\BaseRepository;

class DetailKlienRepository extends BaseRepository
{
    public function __construct(DetailKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}