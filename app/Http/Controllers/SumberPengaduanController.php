<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\SumberPengaduan;

class SumberPengaduanController extends BaseController
{
    public function __construct(SumberPengaduan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}