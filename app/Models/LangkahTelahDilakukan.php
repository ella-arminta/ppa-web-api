<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\LangkahTelahDilakukanRepository;
use App\Services\LangkahTelahDilakukanService;
use App\Http\Resources\LangkahTelahDilakukanResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LangkahTelahDilakukan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'tanggal_pelayanan',
        'pelayanan_yang_diberikan',
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
            'tanggal_pelayanan' => 'required|date',
            'pelayanan_yang_diberikan' => 'required|string',
            'deskripsi' => 'required|string',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*.file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,svg|max:2048'
        ];
    }

    public static function validationRulesPatch()
    {
        return [
            'laporan_id' => 'nullable|exists:laporans,id',
            'tanggal_pelayanan' => 'nullable|date',
            'pelayanan_yang_diberikan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*.file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,svg|max:2048'
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
            'tanggal_pelayanan' => $request->tanggal_pelayanan,
            'pelayanan_yang_diberikan' => $request->pelayanan_yang_diberikan,
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
        return 'App\Http\Controllers\LangkahTelahDilakukanController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new LangkahTelahDilakukanService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new LangkahTelahDilakukanRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new LangkahTelahDilakukanResource($this);
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

    public function laporan(){
        return $this->belongsTo('App\Models\Laporans','laporan_id','id');
    }

}