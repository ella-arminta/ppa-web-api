<?php

namespace App\Services;

use App\Models\Pendidikans;
use App\Services\BaseService;

class PendidikansService extends BaseService
{
    public function __construct(Pendidikans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}