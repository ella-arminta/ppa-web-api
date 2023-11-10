<?php

namespace App\Services\DetailKlien;

use App\Models\DetailKlien\Bpjs;
use App\Services\BaseService;

class BpjsService extends BaseService
{
    public function __construct(Bpjs $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}