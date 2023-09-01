<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Http\Resources\API\RoleResource;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'no_telp',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function service() {

    }

    public function repository() {

    }

    public function resource() {

    }


    public static function resourceData($request) {
        return [
            'id' => $request->id,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            // 'role_id' => $request->role_id,
            'role' => new RoleResource($request->role),
        ];
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

    public function relations() {
        return [
            'role'
        ];
    }
}
