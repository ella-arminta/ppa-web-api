<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\DokumenPendukungRepository;
use App\Services\DokumenPendukungService;
use App\Http\Resources\DokumenPendukungResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DokumenPendukung extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'laporan_id',
        'foto_klien',
        'foto_tempat_tinggal',
        'foto_pendampingan_awal',
        'foto_pendampingan_lanjutan',
        'foto_pendampingan_monitoring',
        'foto_kk',
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
            'foto_klien' => 'nullable|array',
            'foto_klien.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_tempat_tinggal' => 'nullable|array',
            'foto_tempat_tinggal.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_pendampingan_awal' => 'nullable|array',
            'foto_pendampingan_awal.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_pendampingan_lanjutan' => 'nullable|array',
            'foto_pendampingan_lanjutan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_pendampingan_monitoring' => 'nullable|array',
            'foto_pendampingan_monitoring.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kk' => 'nullable|array',
            'foto_kk.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumen_pendukung' => 'nullable|array',
            'dokumen_pendukung.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpeg,png,jpg,gif,svg|max:2048',
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
            'foto_klien' => $request->foto_klien,
            'foto_tempat_tinggal' => $request->foto_tempat_tinggal,
            'foto_pendampingan_awal' => $request->foto_pendampingan_awal,
            'foto_pendampingan_lanjutan' => $request->foto_pendampingan_lanjutan,
            'foto_pendampingan_monitoring' => $request->foto_pendampingan_monitoring,
            'foto_kk' => $request->foto_kk,
            'dokumen_pendukung' => $request->dokumen_pendukung,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\DokumenPendukungController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new DokumenPendukungService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new DokumenPendukungRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new DokumenPendukungResource($this);
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
        return $this->belongsTo(Laporan::class,'laporan_id','id');
    }

}