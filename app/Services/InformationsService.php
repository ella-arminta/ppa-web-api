<?php

namespace App\Services;

use App\Models\Informations;
use App\Services\BaseService;

class InformationsService extends BaseService
{
    public function __construct(Informations $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}