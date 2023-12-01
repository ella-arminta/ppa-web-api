<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\PenangananAwalRepository;
use App\Services\PenangananAwalService;
use App\Http\Resources\PenangananAwalResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PenangananAwal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'penanganan_awals';
    protected $fillable = [
        'laporan_id',
        'tanggal_penanganan_awal',
        'hasil',
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
            'tanggal_penanganan_awal' => 'required|date_format:Y-m-d H:i:s',
            'hasil' => 'required|string',
            'dokumen_pendukung' => 'required|array',
            'dokumen_pendukung.*.file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,svg|max:2048'
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
            'tanggal_penanganan_awal' => $request->tanggal_penanganan_awal,
            'hasil' => $request->hasil,
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
        return 'App\Http\Controllers\PenangananAwalController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new PenangananAwalService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new PenangananAwalRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new PenangananAwalResource($this);
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