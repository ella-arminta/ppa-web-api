<?php

namespace App\Repositories;

use App\Models\Pendidikans;
use App\Repositories\BaseRepository;

class PendidikansRepository extends BaseRepository
{
    public function __construct(Pendidikans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}