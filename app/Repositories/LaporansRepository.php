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

    public function update($id, $data) {
        $foreign = ['status', 'kategori', 'pendidikan', 'satgas Pelapor', 'previous Satgas'];

        foreach ($foreign as $f) {
            $d = str_replace(' ', '', $f);
            if (isset($data[$d])) {
                $f = strtolower($f);
                $f = str_replace(' ', '_', $f);
                $data[$f."_id"] = $data[$d]['id'];
                unset($data[$d]);
            }
        }

        $model = $this->model->findOrFail($id);

        $model->update($data);
        return $model->fresh();
    }

    public function getWithPaginate() {
        return $this->model->with($this->model->relations())->paginate(10);
    }
}