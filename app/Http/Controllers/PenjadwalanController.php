<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Penjadwalan;

class PenjadwalanController extends BaseController
{
    public function __construct(Penjadwalan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}