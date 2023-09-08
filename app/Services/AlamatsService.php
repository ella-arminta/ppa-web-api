<?php

namespace App\Services;

use App\Models\Alamats;
use App\Services\BaseService;

class AlamatsService extends BaseService
{
    public function __construct(Alamats $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}