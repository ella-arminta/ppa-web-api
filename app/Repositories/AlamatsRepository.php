<?php

namespace App\Repositories;

use App\Models\Alamats;
use App\Repositories\BaseRepository;

class AlamatsRepository extends BaseRepository
{
    public function __construct(Alamats $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}