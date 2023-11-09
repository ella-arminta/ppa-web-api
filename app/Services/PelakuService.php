<?php

namespace App\Services;

use App\Models\Pelaku;
use App\Services\BaseService;

class PelakuService extends BaseService
{
    public function __construct(Pelaku $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
    
}