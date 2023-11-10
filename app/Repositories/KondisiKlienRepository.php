<?php

namespace App\Repositories;

use App\Models\KondisiKlien;
use App\Repositories\BaseRepository;

class KondisiKlienRepository extends BaseRepository
{
    public function __construct(KondisiKlien $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}