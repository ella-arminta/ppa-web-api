<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Kecamatans;

class KecamatansController extends BaseController
{
    public function __construct(Kecamatans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}