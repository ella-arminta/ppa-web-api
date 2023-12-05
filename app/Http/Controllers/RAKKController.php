<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\RAKK;

class RAKKController extends BaseController
{
    public function __construct(RAKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}