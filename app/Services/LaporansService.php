<?php

namespace App\Services;

use App\Models\Laporans;
use App\Services\BaseService;

class LaporansService extends BaseService
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}