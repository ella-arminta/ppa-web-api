<?php

namespace App\Repositories\DetailKlien;

use App\Models\DetailKlien\Pekerjaan;
use App\Repositories\BaseRepository;

class PekerjaanRepository extends BaseRepository
{
    public function __construct(Pekerjaan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}