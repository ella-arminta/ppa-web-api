<?php

namespace App\Http\Controllers\DetailKlien;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien\StatusPerkawinan;

class StatusPerkawinanController extends BaseController
{
    public function __construct(StatusPerkawinan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}