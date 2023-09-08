<?php

namespace App\Services;

use App\Models\Kelurahans;
use App\Services\BaseService;

class KelurahansService extends BaseService
{
    public function __construct(Kelurahans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}