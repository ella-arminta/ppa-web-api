<?php

namespace App\Repositories;

use App\Models\Kategoris;
use App\Repositories\BaseRepository;

class KategorisRepository extends BaseRepository
{
    public function __construct(Kategoris $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}