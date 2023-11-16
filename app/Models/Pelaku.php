<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\PelakuRepository;
use App\Services\PelakuService;
use App\Http\Resources\PelakuResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pelaku extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'nama_lengkap',
        'hubungan',
        'usia',
        'satgas_id'
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'laporan_id' => 'required|exists:laporans,id',
            'nama_lengkap' => 'required|string',
            'hubungan' => 'nullable|string',
            'usia' => 'nullable|integer',
            'satgas_id' => 'required|exists:users,id'
        ];
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
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'laporan_id' => $request->laporan_id,
            'nama_lengkap' => $request->nama_lengkap,
            'hubungan' => $request->hubungan,
            'usia' => $request->usia,
            'satgas' => $request->satgas ? new UserResource($request->satgas) : null,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\PelakuController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new PelakuService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new PelakuRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new PelakuResource($this);
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
            'satgas'
        ];
    }
    
    public function laporan()
    {
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }

    public function satgas(){
        return $this->belongsTo('App\Models\User','satgas_id','id');
    }
}