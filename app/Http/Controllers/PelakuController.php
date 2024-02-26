<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Pelaku;

class PelakuController extends BaseController
{
    public function __construct(Pelaku $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}