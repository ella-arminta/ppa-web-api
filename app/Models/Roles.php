<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'name' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(Users::class, 'role_id', 'id');
    }
}
