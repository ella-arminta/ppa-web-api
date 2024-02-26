<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\DetailKasus;

class DetailKasusController extends BaseController
{
    public function __construct(DetailKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}