<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategoris extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategoris';
    /**
     * @var string[]
     */
    protected $fillable = [
        'nama',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'nama' => 'string',
    ];
}
