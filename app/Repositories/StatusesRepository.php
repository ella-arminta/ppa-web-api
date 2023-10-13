<?php

namespace App\Repositories;

use App\Models\Statuses;
use App\Repositories\BaseRepository;

class StatusesRepository extends BaseRepository
{
    public function __construct(Statuses $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */

    public function getCountKasus() {
        $data = $this->model->groupBy('id')->orderBy('id', 'ASC')->get(['id', 'nama']);
        $allKasus = 0;

        foreach($data as $d) {
            $d->totalCase = $d->laporans()->count();
            $allKasus += $d->totalCase;
        }

        $data = $data->toArray();

        $data[] = [
            'id' => 0,
            'nama' => 'Total Kasus',
            'totalCase' => $allKasus
        ];

        return $data;
    }
}