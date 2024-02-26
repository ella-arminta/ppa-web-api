<?php

namespace App\Services\DetailKlien;

use App\Models\DetailKlien\Pekerjaan;
use App\Services\BaseService;

class PekerjaanService extends BaseService
{
    public function __construct(Pekerjaan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}