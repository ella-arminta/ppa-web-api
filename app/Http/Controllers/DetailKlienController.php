<?php

namespace App\Http\Controllers;
use App\Utils\HttpResponseCode;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien;
use Illuminate\Support\Facades\Validator;


class DetailKlienController extends BaseController
{
    public function __construct(DetailKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
    public function getByLaporanId($id)
    {
        $valid = Validator::make(
            ['laporan_id' => $id],
            [
                'laporan_id' => 'required|exists:laporans,id',
            ],
            [
                'laporan_id.required' => 'Laporan id is required!',
                'laporan_id.exists' => 'Laporan id is not exists!',
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }
        return $this->success($this->service->getByLaporanId($id), HttpResponseCode::HTTP_CREATED);
    }
}