<?php

namespace App\Models;

use App\Models\Laporans;
use App\Models\Kelurahans;
use App\Models\ModelUtils;

use App\Repositories\AlamatsRepository;
use App\Services\AlamatsService;
use App\Http\Resources\AlamatsResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Alamats extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'rt',
        'rw',
        'kelurahan_id',
    ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [];
    }

    /**
     * Messages that applied in this model
     *
     * @var array
     */
    public static function validationMessages()
    {
        return [];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        return ModelUtils::filterNullValues([]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\AlamatsController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new AlamatsService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new AlamatsRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new AlamatsResource($this);
    }

    /**
     * Relations associated with this model
     *
     * @var array
     */
    public function relations()
    {
        return [
            'laporan',
            'kelurahan',
        ];
    }

    public function laporans()
    {
        return $this->hasMany(Laporans::class, 'alamat_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahans::class, 'kelurahan_id', 'id');
    }
}
