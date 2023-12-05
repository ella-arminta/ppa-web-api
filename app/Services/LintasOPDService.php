<?php

namespace App\Services;

use App\Models\LintasOPD;
use App\Services\BaseService;

class LintasOPDService extends BaseService
{
    public function __construct(LintasOPD $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}