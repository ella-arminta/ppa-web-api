<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Laporans;

class LaporansController extends BaseController
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}