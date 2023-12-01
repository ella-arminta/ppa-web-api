<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Laporans;

use App\Utils\HttpResponseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



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

    public function setStatusPenjangkauan(Request $request){
        // dd($request->laporan_id);
        $valid = Validator::make(
            [
                'laporan_id' => $request->laporan_id, 
                'jenis' => $request->jenis,
                'status' => $request->status
            ],
            [
                'laporan_id' => 'required|exists:laporans,id',
                'jenis' => 'required|in:detail_klien,keluarga,pelaku,situasi_keluarga,kronologi,harapan_klien_dan_keluarga,kondisi_klien,langkah_telah_dilakukan,dokumen_pendukung',
                'status' => 'required|in:0,1,2'
            ],
            [
                'laporan_id.required' => 'Laporan id is required!',
                'laporan_id.exists' => 'Laporan id is not exists!',
                'jenis.in' => 'Jenis hanya boleh : detail_klien , keluarga, pelaku, kronologi, harapan_klien_dan_keluarga, kondisi_klien, langkah_telah_dilakukan, dokumen_pendukung,  ',
                'status.in' => 'Status hanya boleh : 0, 1, atau 2 (0 = blm input, 1 = draft, 2 = published)'
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }

        return $this->success($this->service->setStatusPenjangkauan(
            $valid->getData()
        ), HttpResponseCode::HTTP_CREATED);
    }
    
    public function getCountByRwKategori() {
        $kelurahan_id = request('kelurahan_id');
        
        $valid = Validator::make(
            [
                'kelurahan_id' => $kelurahan_id
            ],
            [
                'kelurahan_id' => 'required|exists:kelurahans,id'
            ],
            [
                'kelurahan_id.required' => 'Kelurahan id is required!',
                'kelurahan_id.exists' => 'Kelurahan id is not exists!'
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }

        $data = $this->service->getCountByRwKategori($kelurahan_id);
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

    public function cetakLaporan(Request $request){
        $valid = Validator::make(
            [
                'laporan_id' => $request->laporan_id
            ],
            [
                'laporan_id' => 'required|exists:laporans,id'
            ],
            [
                'laporan_id.required' => 'Laporan id is required!',
                'laporan_id.exists' => 'Laporan id is not exists!'
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }
        $data = $this->service->cetakLaporan($request->laporan_id);
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }
}