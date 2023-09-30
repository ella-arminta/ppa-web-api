<?php

namespace App\Repositories;

use App\Models\Kecamatans;
use App\Repositories\BaseRepository;

class KecamatansRepository extends BaseRepository
{
    public function __construct(Kecamatans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}