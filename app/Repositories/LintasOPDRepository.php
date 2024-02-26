<?php

namespace App\Repositories;

use App\Models\LintasOPD;
use App\Repositories\BaseRepository;

class LintasOPDRepository extends BaseRepository
{
    public function __construct(LintasOPD $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
    // public function create($data) {
    //     if(count($this->getByLaporanId($data['laporan_id'])) > 0){
    //         $dokumenPendukung = $this->getByLaporanId($data['laporan_id']);
    //         return $this->update($dokumenPendukung[0]->id, $data);
    //     }
        
    //     return $this->model->create($data);
    // }
}