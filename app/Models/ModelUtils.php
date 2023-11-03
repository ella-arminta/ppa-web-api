<?php

namespace App\Models;

use App\Http\Resources\KronologisResource;
use App\Http\Resources\ProgressReportsResource;
use App\Http\Resources\PendidikansResource;
use App\Http\Resources\KelurahansResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\KategorisResource;
use App\Http\Resources\StatusesResource;
use App\Http\Resources\SumberPengaduanResource;
use Carbon\Carbon;


class ModelUtils
{
    public static function filterNullValues(array $data): array
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }

    public static function checkParam($param)
    {
        return isset($param) && (int)$param == 1;
    }

    public static function rulesPatch($rules)
    {
        if (request()->isMethod('patch')) {
            foreach ($rules as $key => $value) {
                if (str_contains($value, 'required')) {
                    $rules[$key] = str_replace('required', 'sometimes', $value);
                } else {
                    $rules[$key] = $value . "|sometimes";
                }
            }
        }
        return $rules;
    }

    public static function addAttributeWithoutToken($request)
    {

        return [
            'id' => $request->id,
            'tanggal_jam_pengaduan' => $request->tanggal_jam_pengaduan,
            'jam_pengaduan' => $request->jam_pengaduan,
            'uraian_singkat_masalah' => $request->uraian_singkat_masalah,
            'no_telp_pelapor' => $request->no_telp_pelapor,
            'no_telp_klien' => $request->no_telp_klien,
            'nama_klien' => $request->nama_klien,
            'nama_pelapor' => $request->nama_pelapor,
            'inisial_klien' => $request->inisial_klien,
            'nik_pelapor' => $request->nik_pelapor,
            'nik_klien' => $request->nik_klien,
            'validated' => $request->validated,
            'usia' => $request->usia,
            'alamat_pelapor' => $request->alamat_pelapor,
            'alamat_klien' => $request->alamat_klien,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'token' => $request->token,
            'jenis_kelamin' => $request->jenis_kelamin,
            'dokumentasi_pengaduan' => $request->dokumentasi_pengaduan,
            'situasi_keluarga' => $request->situasi_keluarga,
            'kronologis' => $request->kronologis,
            'situasi_keluarga' => $request->situasi_keluarga,
            'harapan_klien_dan_keluarga' => $request->harapan_klien_dan_keluarga,

            'kategori' => new KategorisResource($request->kategori),
            'status' => new StatusesResource($request->status),
            'satgas_pelapor' => $request->satgas_pelapor ? new UserResource($request->satgas_pelapor) : null,
            'previous_satgas' => $request->previous_satgas ? new UserResource($request->previous_satgas) : null,
            'pendidikan' => new PendidikansResource($request->pendidikan),
            'kelurahan' => $request->kelurahan ? new KelurahansResource($request->kelurahan) : null,

            'sumber_pengaduan' => $request->sumber_pengaduan ? new SumberPengaduanResource($request->sumber_pengaduan) : null,

            'dokumentasi_pengaduan' => $request->dokumentasi_pengaduan ? json_decode($request->dokumentasi_pengaduan) : null,
        ];
    }
}
