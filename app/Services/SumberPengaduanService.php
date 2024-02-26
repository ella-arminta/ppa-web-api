<?php

namespace App\Services;

use App\Models\SumberPengaduan;
use App\Services\BaseService;

class SumberPengaduanService extends BaseService
{
    public function __construct(SumberPengaduan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}