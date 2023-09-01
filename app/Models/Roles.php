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

    public static function resourceData($request)
    {
        return [
            'id' => $request->id,
            'name' => $request->name,
        ];
    }

    public function service()
    {
    }

    public function repository()
    {
    }

    public function resource()
    {
    }
    public function relations()
    {
        return [
        ];
    }

    public function users()
    {
        return $this->hasMany(Users::class, 'role_id', 'id');
    }
}
