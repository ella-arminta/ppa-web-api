<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Agama;

class AgamaController extends BaseController
{
    public function __construct(Agama $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}