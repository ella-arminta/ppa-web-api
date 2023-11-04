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
    
    public function setKeluargaKlienDone(Request $request) {

        $valid = Validator::make(
            [
                'status' => $request->status,
                'laporan_id' => $request->laporan_id
            ],
            [
                'status' => 'required|boolean',
                'laporan_id' => 'required|exists:laporans,id'
            ],
            [
                'status.required' => 'status is required!',
                'status.boolean' => 'Status hanya boleh true or false!',
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }
        $data = $this->service->setKeluargaKlienDone($request->status,$request->laporan_id);

        return $this->success($data, HttpResponseCode::HTTP_OK);
    }
}