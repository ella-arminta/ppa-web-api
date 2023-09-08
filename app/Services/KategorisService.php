<?php

namespace App\Services;

use App\Models\Kategoris;
use App\Services\BaseService;

class KategorisService extends BaseService
{
    public function __construct(Kategoris $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}