<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\HubunganKeluargaKlien;

class HubunganKeluargaKlienController extends BaseController
{
    public function __construct(HubunganKeluargaKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}