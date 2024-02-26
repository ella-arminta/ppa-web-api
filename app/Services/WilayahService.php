<?php

namespace App\Services;

use App\Models\Wilayah;
use App\Services\BaseService;

class WilayahService extends BaseService
{
    public function __construct(Wilayah $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}