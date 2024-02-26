<?php

namespace App\Services\DetailKlien;

use App\Models\DetailKlien\KategoriKasus;
use App\Services\BaseService;

class KategoriKasusService extends BaseService
{
    public function __construct(KategoriKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}