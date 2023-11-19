<?php

namespace App\Http\Controllers;
use App\Utils\HttpResponseCode;

use App\Http\Controllers\BaseController;
use App\Models\DetailKlien;
use App\Models\Laporans;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


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

    public function store(Request $request)
    {
        // validate
        // $this->validate($request, $this->model->rules());
        $this->validateRequest($request->all(), $this->model);

        // store
        $data = $this->service->create($request->all());
        
        $laporan = new Laporans();
        if($request->has('nama_klien')){
            $laporan->service->update($request->laporan_id, [
                'nama_klien' =>  $request->nama_klien
            ]);
        }
        if($request->has('nik_klien')){
            $laporan->service->update($request->laporan_id, [
                'nik_klien' => $request->nik_klien
            ]);
        }
        // alamat domisili
        if($request->has('alamat_klien')){
            $laporan->service->update($request->laporan_id, [
                'alamat_klien' => $request->alamat_klien
            ]);
        }

        // return
        return $this->success($data, HttpResponseCode::HTTP_CREATED);

    }

    public function update(Request $request, string $id)
    {
        //validate
        // dd($request->all(),$id);
        $this->validateRequest($request->all(), $this->model);

        //update
        $data = $this->service->update($id, $request->all());

        $laporan = new Laporans();
        
        if($request->has('nama_klien')){
            $laporan->service()->update($request->laporan_id, [
                'nama_klien' =>  $request->nama_klien
            ]);
        }
        if($request->has('nik_klien')){
            $laporan->service()->update($request->laporan_id, [
                'nik_klien' => $request->nik_klien
            ]);
        }
        // alamat domisili
        if($request->has('alamat_klien')){
            $laporan->service()->update($request->laporan_id, [
                'alamat_klien' => $request->alamat_klien
            ]);
        }
        
        //return
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

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