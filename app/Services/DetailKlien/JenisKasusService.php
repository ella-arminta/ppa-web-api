<?php

namespace App\Services\DetailKlien;

use App\Models\DetailKlien\JenisKasus;
use App\Services\BaseService;

class JenisKasusService extends BaseService
{
    public function __construct(JenisKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}