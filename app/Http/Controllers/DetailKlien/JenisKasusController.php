<?php

namespace App\Http\Controllers\DetailKlien;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien\JenisKasus;

class JenisKasusController extends BaseController
{
    public function __construct(JenisKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}