<?php

namespace App\Repositories;

use App\Models\Informations;
use App\Repositories\BaseRepository;

class InformationsRepository extends BaseRepository
{
    public function __construct(Informations $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}