<?php

namespace App\Services;

use App\Models\KondisiKlien;
use App\Services\BaseService;

class KondisiKlienService extends BaseService
{
    public function __construct(KondisiKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}