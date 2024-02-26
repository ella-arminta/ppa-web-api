<?php

namespace App\Services\DetailKlien;

use App\Models\DetailKlien\StatusPerkawinan;
use App\Services\BaseService;

class StatusPerkawinanService extends BaseService
{
    public function __construct(StatusPerkawinan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}