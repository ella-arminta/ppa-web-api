<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Pendidikans;

class PendidikansController extends BaseController
{
    public function __construct(Pendidikans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}