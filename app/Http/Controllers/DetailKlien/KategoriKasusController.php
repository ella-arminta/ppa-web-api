<?php

namespace App\Http\Controllers\DetailKlien;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien\KategoriKasus;

class KategoriKasusController extends BaseController
{
    public function __construct(KategoriKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}