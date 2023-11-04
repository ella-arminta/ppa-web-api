<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Laporans;

use App\Utils\HttpResponseCode;

class LaporansController extends BaseController
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */

    public function getByToken($token) {
        $data = $this->service->getByToken($token);

        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

    public function index()
    {
        $data = $this->service->getAll();

        return $this->success($data->resource, HttpResponseCode::HTTP_OK);
    }
}