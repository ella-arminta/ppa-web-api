<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\LintasOPDRepository;
use App\Services\LintasOPDService;
use App\Http\Resources\LintasOPDResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LintasOPD extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lintas_o_p_ds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'tanggal_pelayanan',
        'instansi',
        'pelayanan_diberikan',
        'deskripsi_pelayanan',
        'dokumentasi'
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
            'tanggal_pelayanan' => 'nullable|date',
            'instansi' => 'nullable|string',
            'pelayanan_diberikan' => 'nullable|string',
            'deskripsi_pelayanan' => 'nullable|string',
            'dokumentasi' => 'nullable|array',
            'dokumentasi.*.file' => 'nullable|file|max:2048'
        ];
    }

    public static function validationRulesPatch()
    {
        return [
            'id' => 'required|exists:lintas_o_p_ds,id',
            'laporan_id' => 'nullable|exists:laporans,id',
            'tanggal_pelayanan' => 'nullable|date',
            'instansi' => 'nullable|string',
            'pelayanan_diberikan' => 'nullable|string',
            'deskripsi_pelayanan' => 'nullable|string',
            'dokumentasi' => 'nullable|array',
            'dokumentasi.*.file' => 'nullable|file|max:2048'
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
            'tanggal_pelayanan' => $request->tanggal_pelayanan,
            'instansi' => $request->instansi,
            'pelayanan_diberikan' => $request->pelayanan_diberikan,
            'deskripsi_pelayanan' => $request->deskripsi_pelayanan,
            'dokumentasi' => $request->dokumentasi ? json_decode($request->dokumentasi) : null,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\LintasOPDController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new LintasOPDService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new LintasOPDRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new LintasOPDResource($this);
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