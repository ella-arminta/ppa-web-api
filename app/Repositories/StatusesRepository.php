<?php

namespace App\Repositories;

use App\Models\Statuses;
use App\Repositories\BaseRepository;

class StatusesRepository extends BaseRepository
{
    public function __construct(Statuses $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}