<?php

namespace App\Services;

use App\Models\Penjadwalan;
use App\Services\BaseService;

class PenjadwalanService extends BaseService
{
    public function __construct(Penjadwalan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}