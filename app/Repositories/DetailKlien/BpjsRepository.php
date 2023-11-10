<?php

namespace App\Repositories\DetailKlien;

use App\Models\DetailKlien\Bpjs;
use App\Repositories\BaseRepository;

class BpjsRepository extends BaseRepository
{
    public function __construct(Bpjs $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}