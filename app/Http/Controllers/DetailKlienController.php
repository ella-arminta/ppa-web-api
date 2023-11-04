<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien;

class DetailKlienController extends BaseController
{
    public function __construct(DetailKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}