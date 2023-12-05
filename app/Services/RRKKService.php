<?php

namespace App\Services;

use App\Models\RRKK;
use App\Services\BaseService;

class RRKKService extends BaseService
{
    public function __construct(RRKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}