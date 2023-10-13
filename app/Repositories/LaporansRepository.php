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

    public function getCountKasus() {
        $data = $this->model->join('statuses', 'statuses.id', '=', 'laporans.status_id')
        ->groupBy('statuses.id', 'laporans.status_id')
        ->selectRaw('status_id as "id", statuses.nama as "status", count(*) as "totalCase"')
        ->get()
        ->toArray();

        return $data;
    }
}