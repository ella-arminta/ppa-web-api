<?php

namespace App\Repositories;

use App\Models\Laporans;
use App\Repositories\BaseRepository;

class LaporansRepository extends BaseRepository
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */

    public function getWithPaginate($params = null)
    {
        $data = $this->model->with($this->model->relations())->orderBy('created_at', 'DESC');

        if (!is_null(request("status")) && (int)request('status') != 0) $data = $data->status((int)request("status"));

        return $data->klien($params)->role()->paginate(10);
    }

    public function getAll()
    {
        $data = $this->model->with($this->model->relations())->orderBy("id", "ASC")->klien(request("search"))->role();

        if (!is_null(request("status")) && (int)request('status') != 0) $data = $data->status((int)request("status"));

        return $data->get();
    }
}
