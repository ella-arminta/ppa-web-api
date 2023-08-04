<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends BaseController
{
    public function __construct() {
        $this->model = new User();
    }
}
