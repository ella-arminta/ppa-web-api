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
        $tanggal_start = request('tanggal_start');
        $tanggal_end = request('tanggal_end');
        
        $valid = Validator::make(
            [
                'kelurahan_id' => $kelurahan_id,
                'tanggal_start' => $tanggal_start,
                'tanggal_end' => $tanggal_end
            ],
            [
                'kelurahan_id' => 'required|exists:kelurahans,id',
                'tanggal_start' => 'nullable|date',
                'tanggal_end' => 'nullable|date|after:tanggal_start'
            ],
            [
                'kelurahan_id.required' => 'Kelurahan id is required!',
                'kelurahan_id.exists' => 'Kelurahan id is not exists!',
                'tanggal_end.after' => 'Tanggal end must be a date after Tanggal start.'
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }

        $data = $this->service->getCountByRwKategori($kelurahan_id,$tanggal_start,$tanggal_end);
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

    public function rekapTahunan(Request $request){
        $valid = Validator::make(
            [
                'thn_awal' => $request->thn_awal,
                'thn_akhir' => $request->thn_akhir,
                'kategori_id' => $request->kategori_id,
                'kategori_kasus_id' => $request->kategori_kasus_id
            ],
            [
                'thn_awal' => 'required|date_format:Y',
                'thn_akhir' => 'required|date_format:Y|after:thn_awal',
                'kategori_id' => 'nullable|exists:kategoris,id',
                'kategori_kasus_id' => 'nullable|exists:kategori_kasuses,id'
            ],
            [
                'kategori_id.exists' => 'Kategori adalah tipe permasalahan. Kategori id tidak ditemukan!',
                'kategori_kasus_id.exists' => 'Kategori kasus id tidak ditemukan!',
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }
        if(!$request->has('kategori_id')){
            $request['kategori_id'] =  null;
        }
        if($request->has('kategori_kasus_id')){
            $request['kategori_kasus_id'] =  null;
        }
        $data = $this->service->rekapTahunan($request->thn_awal,$request->thn_akhir, $request->kategori_id, $request->kategori_kasus_id);
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

    public function rekapKasusKlien(Request $request){
        $valid = Validator::make(
            [
                'periode_tanggal' => $request->periode_tanggal,
                'tgl_awal' => $request->tgl_awal,
                'tgl_akhir' => $request->tgl_akhir,
                'kategori_id' => $request->kategori_id,
                'kategori_klien' => $request->kategori_klien,
                'kategori_kasus_klien_id' => $request->kategori_kasus_klien_id,
                'kecamatan_id' => $request->kecamatan_id,
                'pendidikan_id' => $request->pendidikan_id,
            ],
            [
                'periode_tanggal' => 'required|in:semua,bulanini,3bulan,1tahun,tanggal',
                'tgl_awal' => 'nullable|date',
                'tgl_akhir' => 'nullable|date|after:tgl_awal',
                'kategori_id' => 'nullable|exists:kategoris,id',
                'kategori_klien' => 'nullable|string|in:anak,dewasa',
                'kategori_kasus_klien_id' => 'nullable|exists:kategori_kasuses,id',
                'kecamatan_id' => 'nullable|exists:kecamatans,id',
                'pendidikan_id' => 'nullable|exists:pendidikans,id',
            ],
            [
                'periode_tanggal.in' => 'Periode tanggal hanya boleh : semua, bulanini, 3bulan, 1tahun, tanggal',
            ]
        );
        
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }
        
        $validatedData = $valid->validated();

        if($validatedData['periode_tanggal'] == 'semua'){
            $validatedData['tgl_awal'] = null;
            $validatedData['tgl_akhir'] = null;
        }else if($validatedData['periode_tanggal'] == 'bulanini'){
            $validatedData['tgl_awal'] = date('Y-m-01');
            $validatedData['tgl_akhir'] = date('Y-m-t');
        }else if($validatedData['periode_tanggal'] == '3bulan'){
            $validatedData['tgl_awal'] = date('Y-m-d', strtotime('-3 months'));
            $validatedData['tgl_akhir'] = date('Y-m-d');
        } else if($validatedData['periode_tanggal'] == '1tahun'){
            $validatedData['tgl_awal'] = date('Y-m-d', strtotime('-1 year'));
            $validatedData['tgl_akhir'] = date('Y-m-d');
        } else if($validatedData['periode_tanggal'] == 'tanggal'){
            $validatedData['tgl_awal'] = $validatedData['tgl_awal'];
            $validatedData['tgl_akhir'] = $validatedData['tgl_akhir'];
        }
        
        $data = $this->service->rekapKasusKlien($validatedData);
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }
}