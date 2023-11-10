<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\KondisiKlien;

class KondisiKlienController extends BaseController
{
    public function __construct(KondisiKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}