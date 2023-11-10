<?php

namespace App\Services;

use App\Models\Agama;
use App\Services\BaseService;

class AgamaService extends BaseService
{
    public function __construct(Agama $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}