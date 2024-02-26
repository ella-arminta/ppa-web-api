<?php

namespace App\Services;

use App\Models\Kota;
use App\Services\BaseService;

class KotaService extends BaseService
{
    public function __construct(Kota $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}