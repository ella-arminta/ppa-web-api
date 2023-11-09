<?php

namespace App\Repositories;

use App\Models\HubunganKeluargaKlien;
use App\Repositories\BaseRepository;

class HubunganKeluargaKlienRepository extends BaseRepository
{
    public function __construct(HubunganKeluargaKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}