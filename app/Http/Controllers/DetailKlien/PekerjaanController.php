<?php

namespace App\Http\Controllers\DetailKlien;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien\Pekerjaan;

class PekerjaanController extends BaseController
{
    public function __construct(Pekerjaan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}