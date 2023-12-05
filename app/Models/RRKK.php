<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\RRKKRepository;
use App\Services\RRKKService;
use App\Http\Resources\RRKKResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RRKK extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'ekonomi',
        'pendidikan',
        'sosial',
        'kesehatan',
        'hukum'
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
            'ekonomi' => 'required|string',
            'pendidikan' => 'required|string',
            'sosial' => 'required|string',
            'kesehatan' => 'required|string',
            'hukum' => 'required|string',
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
            'laporan_id' => $request->laporan_id,
            'id' => $request->id,
            'ekonomi' => $request->ekonomi,
            'pendidikan' => $request->pendidikan,
            'sosial' => $request->sosial,
            'kesehatan' => $request->kesehatan,
            'hukum' => $request->hukum
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\RRKKController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new RRKKService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new RRKKRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new RRKKResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'laporan'
        ];
    }

    public function laporan()
    {
        return $this->belongsTo('App\Models\Laporans','laporan_id','id');
    }

}