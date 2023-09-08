<?php

namespace App\Services;

use App\Models\Kecamatans;
use App\Services\BaseService;

class KecamatansService extends BaseService
{
    public function __construct(Kecamatans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}