<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Kronologis;

class KronologisController extends BaseController
{
    public function __construct(Kronologis $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}