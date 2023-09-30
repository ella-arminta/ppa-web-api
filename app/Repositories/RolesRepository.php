<?php

namespace App\Repositories;

use App\Models\Roles;
use App\Repositories\BaseRepository;

class RolesRepository extends BaseRepository
{
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}