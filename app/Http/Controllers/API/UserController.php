<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends BaseController
{
    public function __construct(User $user) {
        parent::__construct($user);
    }
}
