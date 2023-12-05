<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\LintasOPD;

class LintasOPDController extends BaseController
{
    public function __construct(LintasOPD $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}