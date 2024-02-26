<?php

namespace App\Services;

use App\Models\DetailKasus;
use App\Services\BaseService;

class DetailKasusService extends BaseService
{
    public function __construct(DetailKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}