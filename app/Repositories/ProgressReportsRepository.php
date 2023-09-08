<?php

namespace App\Repositories;

use App\Models\ProgressReports;
use App\Repositories\BaseRepository;

class ProgressReportsRepository extends BaseRepository
{
    public function __construct(ProgressReports $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */
}