<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}