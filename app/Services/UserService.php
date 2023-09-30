<?php

namespace App\Services;

use App\Models\User;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}