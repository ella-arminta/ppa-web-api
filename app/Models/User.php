<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\ModelUtils;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Http\Resources\RolesResource;
use App\Http\Resources\KronologisResource;
use App\Http\Resources\LaporansResource;
use App\Http\Resources\ProgressReportsResource;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuids;

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

    public static function validationRules()
    {
        if (request()->isMethod('put')) {
            return [
                'nama' => 'sometimes|required',
                'no_telp' => 'sometimes|required',
                'password' => 'sometimes|required',
                'role_id' => 'sometimes|required',
            ];
        }
        return [
            'nama' => 'sometimes|required',
            'no_telp' => 'sometimes|required',
            'password' => 'sometimes|required',
            'role_id' => 'sometimes|required',
        ];
    }

    /**
     * Messages that applied in this model
     *
     * @var array
     */
    public static function validationMessages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'no_telp.required' => 'No Telp tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'role_id.required' => 'Role tidak boleh kosong',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'noTelp' => $request->no_telp,
            'email' => $request->email,
            'role' => new RolesResource($request->role),
            'kronologis' => KronologisResource::collection($request->kronologis),
            'laporans' => LaporansResource::collection($request->laporans),
            'progressReports' => ProgressReportsResource::collection($request->progress_reports),
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\UserController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new UserService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new UserRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new UserResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */

    
    public function relations() {
        return [
            'role',
            'laporans',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

    public function laporans()
    {
        return $this->hasMany('App\Models\Laporans', 'satgas_pelapor_id', 'id');
    }
    public function previous_laporans()
    {
        return $this->hasMany('App\Models\Laporans', 'previous_satgas_id', 'id');
    }

    public function progress_reports() {
        return $this->hasMany('App\Models\ProgressReports', 'admin_id', 'id');
    }

    public function kronologis() {
        return $this->hasMany('App\Models\Kronologis', 'admin_id', 'id');
    }

    // public function getRoleAttribute()
    // {
    //     return new RoleResource($this->role()->first());
    // }
}
