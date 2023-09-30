<?php

namespace App\Services;

use App\Models\ProgressReports;
use App\Services\BaseService;

class ProgressReportsService extends BaseService
{
    public function __construct(ProgressReports $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}