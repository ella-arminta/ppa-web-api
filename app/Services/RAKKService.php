<?php

namespace App\Services;

use App\Models\RAKK;
use App\Services\BaseService;

class RAKKService extends BaseService
{
    public function __construct(RAKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}