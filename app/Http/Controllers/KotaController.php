<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Kota;

class KotaController extends BaseController
{
    public function __construct(Kota $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}