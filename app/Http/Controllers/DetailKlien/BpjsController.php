<?php

namespace App\Http\Controllers\DetailKlien;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien\Bpjs;

class BpjsController extends BaseController
{
    public function __construct(Bpjs $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}