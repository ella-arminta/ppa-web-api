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

    public function store(Request $request)
    {
        // kalau kirim array of keluarga
        if($request->has('data') && is_array($request->data)){
            $hasil = [];
            foreach($request->data as $key => $value){
                $this->validateRequest($value, $this->model);
                $data = $this->service->create($value);
                $hasil[] = $data;
            }
            return $this->success($hasil, HttpResponseCode::HTTP_CREATED);
        }else{ //kirim 1 keluarga

            $this->validateRequest($request->all(), $this->model);
            // store
            $data = $this->service->create($request->all());
            // return
            return $this->success($data, HttpResponseCode::HTTP_CREATED);
        }


    }
}