<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Kelurahans;

class KelurahansController extends BaseController
{
    public function __construct(Kelurahans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}