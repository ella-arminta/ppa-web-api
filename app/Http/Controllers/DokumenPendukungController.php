<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\DokumenPendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Utils\HttpResponseCode;

class DokumenPendukungController extends BaseController
{
    public function __construct(DokumenPendukung $model)
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
        $validator = Validator::make(
            $request->all(), 
            [
                'laporan_id' => 'required|exists:laporans,id',
                'dokumen_pendukung' => 'required|array',
                'dokumen_pendukung.*.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ], 
            [
                'laporan_id.required' => 'Laporan tidak boleh kosong',
                'laporan_id.exists' => 'Laporan tidak ditemukan',
                'dokumen_pendukung.array' => 'Data harus berupa array',
                'dokumen_pendukung.*.file' => 'Data harus berupa file',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $newData['laporan_id'] = $request->laporan_id;
        $fillable = $this->model->getFillable();
        foreach ($fillable as $f) {
            if($f == 'laporan_id') continue;
            if (isset($request['dokumen_pendukung'][$f])) {
                $newData[$f] = $request['dokumen_pendukung'][$f];
            }
        }
        // dd($newData);
        // store
        $data = $this->service->create($newData);

        // return
        return $this->success($data, HttpResponseCode::HTTP_CREATED);

    }

}