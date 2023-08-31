<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;

use App\Models\Laporans;

use Illuminate\Http\Request;

class LaporanController extends BaseController
{
    public function __construct(Laporans $laporan) {
        parent::__construct($laporan);
    }
}
