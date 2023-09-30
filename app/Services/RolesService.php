<?php

namespace App\Services;

use App\Models\Roles;
use App\Services\BaseService;

class RolesService extends BaseService
{
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}