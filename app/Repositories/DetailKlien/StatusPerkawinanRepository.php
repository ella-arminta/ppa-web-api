<?php

namespace App\Repositories\DetailKlien;

use App\Models\DetailKlien\StatusPerkawinan;
use App\Repositories\BaseRepository;

class StatusPerkawinanRepository extends BaseRepository
{
    public function __construct(StatusPerkawinan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}