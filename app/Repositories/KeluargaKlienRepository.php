<?php

namespace App\Repositories;

use App\Models\DetailKlien;
use App\Models\KeluargaKlien;
use App\Repositories\BaseRepository;

class KeluargaKlienRepository extends BaseRepository
{
    public function __construct(KeluargaKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
    public function setKeluargaKlienDone($status,$laporan_id){
        $detailKlien = DetailKlien::where('laporan_id', $laporan_id)->first();
        $detailKlien->is_done_keluarga = $status;
        $detailKlien->save();

        $detailKlien = DetailKlien::where('laporan_id', $laporan_id)->first();
        return $detailKlien;
    }
}