<?php

namespace App\Repositories;

use App\Models\Kelurahans;
use App\Repositories\BaseRepository;

class KelurahansRepository extends BaseRepository
{
    public function __construct(Kelurahans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}