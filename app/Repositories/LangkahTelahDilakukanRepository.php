<?php

namespace App\Repositories;

use App\Models\LangkahTelahDilakukan;
use App\Repositories\BaseRepository;

class LangkahTelahDilakukanRepository extends BaseRepository
{
    public function __construct(LangkahTelahDilakukan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}