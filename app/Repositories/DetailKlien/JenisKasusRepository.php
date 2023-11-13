<?php

namespace App\Repositories\DetailKlien;

use App\Models\DetailKlien\JenisKasus;
use App\Repositories\BaseRepository;

class JenisKasusRepository extends BaseRepository
{
    public function __construct(JenisKasus $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}