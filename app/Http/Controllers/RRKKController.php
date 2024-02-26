<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\RRKK;

class RRKKController extends BaseController
{
    public function __construct(RRKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}