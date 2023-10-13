<?php

namespace App\Services;

use App\Models\Statuses;
use App\Services\BaseService;

class StatusesService extends BaseService
{
    public function __construct(Statuses $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */

    public function getCountKasus() {
        $data = $this->repository->getCountKasus();
    
        return $data;
    }
}