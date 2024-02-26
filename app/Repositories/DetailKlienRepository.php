<?php

namespace App\Repositories;

use App\Models\DetailKlien;
use App\Repositories\BaseRepository;

class DetailKlienRepository extends BaseRepository
{
    public function __construct(DetailKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */

    public function getByLaporanId($id){
        return $this->model->with($this->model->relations())->where('laporan_id',$id)->first();
    }
}