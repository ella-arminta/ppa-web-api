<?php

namespace App\Services;

use App\Models\HubunganKeluargaKlien;
use App\Services\BaseService;

class HubunganKeluargaKlienService extends BaseService
{
    public function __construct(HubunganKeluargaKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}