<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Statuses;

use App\Utils\HttpResponseCode;

class StatusesController extends BaseController
{
    public function __construct(Statuses $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */

    public function getCountKasus() {
        $data = $this->service->getCountKasus();
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }
}