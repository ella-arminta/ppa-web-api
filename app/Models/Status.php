<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
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
