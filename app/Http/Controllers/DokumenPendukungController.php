<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\DokumenPendukung;

class DokumenPendukungController extends BaseController
{
    public function __construct(DokumenPendukung $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}