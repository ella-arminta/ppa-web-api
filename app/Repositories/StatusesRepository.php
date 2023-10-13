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

        foreach($data as $d) {
            $d->totalCase = $d->laporans()->count();
        }

        return $data->toArray();
    }
}