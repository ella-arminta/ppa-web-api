<?php

namespace App\Services;

use App\Models\Kronologis;
use App\Services\BaseService;

class KronologisService extends BaseService
{
    public function __construct(Kronologis $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}