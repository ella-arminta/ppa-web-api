<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;

use App\Models\Kategoris;

use Illuminate\Http\Request;

class KategoriController extends BaseController
{
    public function __construct(Kategoris $kategori) {
        parent::__construct($kategori);
    }
}
