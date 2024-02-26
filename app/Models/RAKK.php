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
        'kebutuhan',
        'deskripsi',
        'dokumen_pendukung'
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
            'kebutuhan' => 'required|string|in:Kesehatan,Pendidikan,Ekonomi,Hukum',
            'deskripsi' => 'required|string',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*.file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,svg|max:10240'
        ];
    }

    public static function validationRulesPatch()
    {
        return [            
            'id' => 'required|exists:r_a_k_k_s,id',
            'laporan_id' => 'nullable|exists:laporans,id',
            'kebutuhan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*.file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,svg|max:10240'
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
            'kebutuhan' => $request->kebutuhan,
            'deskripsi' => $request->deskripsi,
            'dokumen_pendukung' => $request->dokumen_pendukung ? json_decode($request->dokumen_pendukung) : null
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