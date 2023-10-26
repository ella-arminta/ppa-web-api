<?php

namespace App\Models;

use App\Http\Resources\KronologisResource;
use App\Http\Resources\ProgressReportsResource;
use App\Http\Resources\PendidikansResource;
use App\Http\Resources\KelurahansResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\KategorisResource;
use App\Http\Resources\StatusesResource;
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
            foreach($rules as $key => $value) {
                if (str_contains($value, 'required')) {
                    $rules[$key] = str_replace('required', 'sometimes', $value);
                } else {
                    $rules[$key] = $value."|sometimes";
                }
            }
        }
        return $rules;
    }

    public static function addAttributeWithoutToken($request) {

        return [
            'id' => $request->id,
            'judul' => $request->judul,
            'no_telp_pelapor' => $request->no_telp_pelapor,
            'nama_korban' => $request->nama_korban,
            'nama_pelapor' => $request->nama_pelapor,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'token' => $request->token,
            'kategori' => new KategorisResource($request->kategori),
            'status' => new StatusesResource($request->status),
            'satgas_pelapor' => $request->satgas_pelapor ? new UserResource($request->satgas_pelapor) : null,
            'previous_satgas' => $request->previous_satgas ? new UserResource($request->previous_satgas) : null,
            'pendidikan' => new PendidikansResource($request->pendidikan),
            'kelurahan' => $request->kelurahan ? new KelurahansResource($request->kelurahan) : null,
            'kronologis' => KronologisResource::collection($request->kronologis),
            'progress_reports' => ProgressReportsResource::collection($request->progress_reports),
            'created_at' => Carbon::parse($request->created_at)->format('d-m-Y'),
        ];
    }
}
