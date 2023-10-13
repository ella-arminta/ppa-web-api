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
        $foreign = ['status', 'kategori', 'pendidikan'];

        foreach ($foreign as $f) {
            if (isset($data[$f])) {
                $data[$f."_id"] = $data[$f]['id'];
                unset($data[$f]);
            }
        }

        $model = $this->model->findOrFail($id);

        $model->update($data);
        return $model->fresh();
    }
}