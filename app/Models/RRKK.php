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
        'kebutuhan',
        'opd',
        'layanan_yang_diberikan',
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
            'kebutuhan' => 'nullable|string',
            'opd' => 'required|string|in:Surabaya',
            'layanan_yang_diberikan' => 'nullable|string',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ];
    }

    public static function validationRulesPatch()
    {
        return [
            'id' => 'required|exists:r_r_k_k_s,id',
            'laporan_id' => 'nullable|exists:laporans,id',
            'kebutuhan' => 'nullable|string',
            'opd' => 'nullable|string|in:Surabaya',
            'layanan_yang_diberikan' => 'nullable|string',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
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
            'opd' => $request->OPD,
            'layanan_yang_diberikan' => $request->layanan_yang_diberikan,
            'dokumen_pendukung' => $request->dokumen_pendukung ? json_decode($request->dokumen_pendukung) : null,
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