<?php

namespace App\Repositories;

use App\Models\SumberPengaduan;
use App\Repositories\BaseRepository;

class SumberPengaduanRepository extends BaseRepository
{
    public function __construct(SumberPengaduan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}