<?php

namespace App\Repositories\DetailKlien;

use App\Models\DetailKlien\KategoriKasus;
use App\Repositories\BaseRepository;

class KategoriKasusRepository extends BaseRepository
{
    public function __construct(KategoriKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}