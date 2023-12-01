<?php

namespace App\Services;

use App\Models\LangkahTelahDilakukan;
use App\Services\BaseService;

class LangkahTelahDilakukanService extends BaseService
{
    public function __construct(LangkahTelahDilakukan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
}