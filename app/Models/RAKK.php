<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\RAKKRepository;
use App\Services\RAKKService;
use App\Http\Resources\RAKKResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RAKK extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'pend_psikologis',
        'pend_medis',
        'pend_hukum',
        'psikososial',
        'rumah_aman',
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
            'pend_psikologis' => 'required|string',
            'pend_medis' => 'required|string',
            'pend_hukum' => 'required|string',
            'psikososial' => 'required|string',
            'rumah_aman' => 'required|string|in:Shelter ABH,Shelter Anak Perempuan',
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
            'pend_psikologis' => $request->pend_psikologis,
            'pend_medis' => $request->pend_medis,
            'pend_hukum' => $request->pend_hukum,
            'psikososial' => $request->psikososial,
            'rumah_aman' => $request->rumah_aman,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\RAKKController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new RAKKService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new RAKKRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new RAKKResource($this);
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
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }
}