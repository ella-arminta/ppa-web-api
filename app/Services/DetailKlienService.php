<?php

namespace App\Services;

use App\Models\DetailKlien;
use App\Services\BaseService;

class DetailKlienService extends BaseService
{
    public function __construct(DetailKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}