<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\PenangananAwal;

class PenangananAwalController extends BaseController
{
    public function __construct(PenangananAwal $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}