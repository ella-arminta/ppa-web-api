<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Statuses;

class StatusesController extends BaseController
{
    public function __construct(Statuses $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}