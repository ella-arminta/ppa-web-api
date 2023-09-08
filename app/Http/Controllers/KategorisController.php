<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Kategoris;

class KategorisController extends BaseController
{
    public function __construct(Kategoris $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}