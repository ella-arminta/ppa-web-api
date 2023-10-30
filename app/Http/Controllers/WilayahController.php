<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Wilayah;

class WilayahController extends BaseController
{
    public function __construct(Wilayah $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}