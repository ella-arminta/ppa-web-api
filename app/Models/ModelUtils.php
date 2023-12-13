<?php

namespace App\Models;

use App\Http\Resources\DetailKasusResource;
use App\Http\Resources\DetailKlienResource;
use App\Http\Resources\DokumenPendukungResource;
use App\Http\Resources\KronologisResource;
use App\Http\Resources\ProgressReportsResource;
use App\Http\Resources\PendidikansResource;
use App\Http\Resources\KelurahansResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\KategorisResource;
use App\Http\Resources\KeluargaKlienResource;
use App\Http\Resources\KondisiKlienResource;
use App\Http\Resources\KotaResource;
use App\Http\Resources\LangkahTelahDilakukanResource;
use App\Http\Resources\LintasOPDResource;
use App\Http\Resources\PelakuResource;
use App\Http\Resources\PenangananAwalResource;
use App\Http\Resources\PenjadwalanResource;
use App\Http\Resources\RAKKResource;
use App\Http\Resources\RRKKResource;
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
        $withKeluargaKlien = ModelUtils::checkParam(request('withKeluargaKlien'));
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
            'kronologi_kejadian' => $request->kronologi_kejadian,
            'harapan_klien_dan_keluarga' => $request->harapan_klien_dan_keluarga,
            'detail_kasus' => $request->detail_kasus ? new DetailKasusResource($request->detail_kasus) : null,
            
            // Status Penjangkauan
            'status_detail_klien' => (int) $request->status_detail_klien,
            'status_keluarga' => (int) $request->status_keluarga,
            'status_pelaku' => (int) $request->status_pelaku,
            'status_situasi_keluarga' => (int) $request->status_situasi_keluarga,
            'status_kronologi' => (int) $request->status_kronologi,
            'status_harapan_klien_dan_keluarga' => (int) $request->status_harapan_klien_dan_keluarga,
            'status_kondisi_klien' => (int) $request->status_kondisi_klien,
            'status_langkah_telah_dilakukan' => (int) $request->status_langkah_telah_dilakukan,
            'status_dokumen_pendukung' => (int) $request->status_dokumen_pendukung,



            'kategori' => new KategorisResource($request->kategori),
            'status' => new StatusesResource($request->status),
            'satgas_pelapor' => $request->satgas_pelapor ? new UserResource($request->satgas_pelapor) : null,
            'previous_satgas' => $request->previous_satgas ? new UserResource($request->previous_satgas) : null,
            'pendidikan' => new PendidikansResource($request->pendidikan),
            'kelurahan' => $request->kelurahan ? new KelurahansResource($request->kelurahan) : null,

            'sumber_pengaduan' => $request->sumber_pengaduan ? new SumberPengaduanResource($request->sumber_pengaduan) : null,

            'dokumentasi_pengaduan' => $request->dokumentasi_pengaduan ? json_decode($request->dokumentasi_pengaduan) : null,
            'detail_klien' => $request->detail_klien ? new DetailKlienResource($request->detail_klien) : null ,
            'keluarga_klien' => $withKeluargaKlien ? KeluargaKlienResource::collection($request->keluarga_klien) : null,
            'pelaku' => $request->pelaku ?  new PelakuResource($request->pelaku) : null,
            'kondisi_klien' => $request->kondisi_klien ?  new KondisiKlienResource($request->kondisi_klien) : null,
            'penjadwalan' => $request->penjadwalan ? new PenjadwalanResource($request->penjadwalan) : null,
            'dokumen_pendukung' => $request->dokumen_pendukung ? new DokumenPendukungResource($request->dokumen_pendukung) : null,
            'nomor_register' => $request->nomor_register,
            'tanggal_penjangkauan' => $request->tanggal_penjangkauan,
            'kota_pelapor' => $request->kota_pelapor ? new KotaResource($request->kota_pelapor) : null,

            'status_rakk' => (int) $request->status_rakk,
            'status_rrkk' => (int) $request->status_rrkk,
            'status_lintas_opd' => (int) $request->status_lintas_opd,

            'penanganan_awal' => $request->penanganan_awal ? new PenangananAwalResource($request->penanganan_awal) : null,
            'langkah_telah_dilakukan' => LangkahTelahDilakukanResource::collection($request->langkah_telah_dilakukan),
            'RAKK' => RAKKResource::collection($request->RAKK),
            'RRKK' => RRKKResource::collection($request->RRKK),
            'lintas_opd' => LintasOPDResource::collection($request->lintas_opd),

            'updated_at_keluarga' => $request->updated_at_keluarga,
            'updated_at_detail_klien' => $request->updated_at_detail_klien,
            'updated_at_pelaku' => $request->updated_at_pelaku,
            'updated_at_situasi_keluarga' => $request->updated_at_situasi_keluarga,
            'updated_at_kronologi' => $request->updated_at_kronologi,
            'updated_at_kondisi_klien' => $request->updated_at_kondisi_klien,
            'updated_at_langkah_telah_dilakukan' => $request->updated_at_langkah_telah_dilakukan,
            'updated_at_rakk' => $request->updated_at_rakk,
            'updated_at_rrkk' => $request->updated_at_rrkk,
            'updated_at_lintas_opd' => $request->updated_at_lintas_opd,
            'updated_by_keluarga' => $request->updated_by_keluarga,
            'updated_by_detail_klien' => $request->updated_by_detail_klien ,
            'updated_by_pelaku' => $request->updated_by_pelaku ,
            'updated_by_situasi_keluarga' => $request->updated_by_situasi_keluarga ,
            'updated_by_kronologi' => $request->updated_by_kronologi ,
            'updated_by_kondisi_klien' => $request->updated_by_kondisi_klien ,
            'updated_by_langkah_telah_dilakukan' => $request->updated_by_langkah_telah_dilakukan ,
            'updated_by_rakk' => $request->updated_by_rakk ,
            'updated_by_rrkk' => $request->updated_by_rrkk ,
            'updated_by_lintas_opd' => $request->updated_by_lintas_opd,
        ];
    }
}
