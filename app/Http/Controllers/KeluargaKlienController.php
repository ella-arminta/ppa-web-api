<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\KeluargaKlien;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


use App\Utils\HttpResponseCode;

class KeluargaKlienController extends BaseController
{
    public function __construct(KeluargaKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */

    public function index()
    {
        $data = $this->service->getAll();

        return $this->success($data->resource, HttpResponseCode::HTTP_OK);
    }
}