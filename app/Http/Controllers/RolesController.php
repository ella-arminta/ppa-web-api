<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Roles;

class RolesController extends BaseController
{
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}