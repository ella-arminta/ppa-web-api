<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\LangkahTelahDilakukan;

class LangkahTelahDilakukanController extends BaseController
{
    public function __construct(LangkahTelahDilakukan $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}