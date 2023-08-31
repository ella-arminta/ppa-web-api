<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporans extends Model
{
    // masih kosong kok tenang aja
    use HasFactory, SoftDeletes;

    protected $table = 'laporans';
    /**
     * @var string[]
     */
    protected $fillable = [
        '',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        '' => '',
    ];
}
