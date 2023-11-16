<?php

namespace App\Models;

use App\Http\Resources\UserResource;
use App\Models\ModelUtils;
use App\Repositories\KondisiKlienRepository;
use App\Services\KondisiKlienService;
use App\Http\Resources\KondisiKlienResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KondisiKlien extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'fisik',
        'psikologis',
        'sosial',
        'spiritual',
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
            'fisik' => 'required|string',
            'psikologis' => 'required|string',
            'sosial' => 'required|string',
            'spiritual' => 'required|string',
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
            'id' => $this->id,
            'laporan_id' => $request->laporan_id,
            'fisik' => $request->fisik,
            'psikologis' => $request->psikologis,
            'sosial' => $request->sosial,
            'spiritual' => $request->spiritual,
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
        return 'App\Http\Controllers\KondisiKlienController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KondisiKlienService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KondisiKlienRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KondisiKlienResource($this);
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

    public function satgas()
    {
        return $this->belongsTo('App\Models\User', 'satgas_id', 'id');
    }
}