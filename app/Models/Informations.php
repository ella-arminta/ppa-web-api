<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'isi'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'nama' => 'string',
        'isi' => 'string'
    ];
}
