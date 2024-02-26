<?php

namespace App\Services;

use App\Models\DetailKlien;
use App\Models\KeluargaKlien;
use App\Repositories\DetailKlienRepository;
use App\Services\BaseService;


class KeluargaKlienService extends BaseService
{
    public function __construct(KeluargaKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}