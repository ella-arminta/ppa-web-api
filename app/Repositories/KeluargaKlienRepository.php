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
    public function getAll()
    {
        $data = $this->getAllWith();

        return $data;
    }

    private function getAllWith(){
        if (request('laporan_id')){
            return $this->model->with($this->model->relations())->orderBy("id", "ASC")->where('laporan_id',request('laporan_id'))->get();
        }
        return $this->model->with($this->model->relations())->orderBy("id", "ASC")->get();
    }
}