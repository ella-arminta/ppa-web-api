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

    public function update($id, $data)
    {
        $foreign = ['status', 'kategori', 'pendidikan', 'satgas Pelapor', 'previous Satgas'];

        foreach ($foreign as $f) {
            $d = str_replace(' ', '', $f);
            if (isset($data[$d])) {
                $f = strtolower($f);
                $f = str_replace(' ', '_', $f);
                $data[$f . "_id"] = $data[$d]['id'];
                unset($data[$d]);
            }
        }

        $model = $this->model->findOrFail($id);

        $model->update($data);
        return $model->fresh();
    }

    public function getWithPaginate($params = null)
    {
        $data = $this->model->with($this->model->relations())->orderBy('created_at', 'DESC');

        if (!is_null(request("status")) && (int)request('status') != 0) $data = $data->status((int)request("status"));

        return $data->klien($params)->paginate(10);
    }

    public function getAll()
    {
        $data = $this->model->with($this->model->relations())->orderBy("id", "ASC")->klien(request("search"));

        if (!is_null(request("status")) && (int)request('status') != 0) $data = $data->status((int)request("status"));

        return $data->get();
    }
}
