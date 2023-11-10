<?php

namespace App\Repositories;

use App\Models\Agama;
use App\Repositories\BaseRepository;

class AgamaRepository extends BaseRepository
{
    public function __construct(Agama $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}