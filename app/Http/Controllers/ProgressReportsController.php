<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\ProgressReports;

class ProgressReportsController extends BaseController
{
    public function __construct(ProgressReports $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}