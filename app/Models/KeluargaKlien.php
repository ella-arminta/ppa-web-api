<?php

namespace App\Models;

use App\Http\Resources\API\LaporanResource;
use App\Http\Resources\DetailKlienResource;
use App\Http\Resources\HubunganKeluargaKlienResource;
use App\Models\ModelUtils;
use App\Repositories\KeluargaKlienRepository;
use App\Services\KeluargaKlienService;
use App\Http\Resources\KeluargaKlienResource;
use App\Http\Resources\KotaResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KeluargaKlien extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'hubungan_id',
        'nama_lengkap',
        'no_telp',
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
            'hubungan_id' => 'required|exists:hubungan_keluarga_kliens,id',
            'nama_lengkap' => 'required|string',
            'no_telp' => 'nullable|string',
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
        return [
            'hubungan.in' => 'Hubungan dengan Klien hanya boleh : Suami, Istri, Anak Kandung, Ayah Kandung, Ibu Kandung, Saudara'
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withLaporan = ModelUtils::checkParam(request('withLaporan'));
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'hubungan' => new HubunganKeluargaKlienResource($request->hubungan),
            'nama_lengkap' => $request->nama_lengkap,
            'no_telp' => $request->no_telp,
            'laporan_id' => $request->laporan_id,
            'laporan' => $withLaporan ? new LaporanResource($request->laporans) : null,
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
        return 'App\Http\Controllers\KeluargaKlienController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KeluargaKlienService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KeluargaKlienRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KeluargaKlienResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'laporans',
            'hubungan',
            'satgas'
        ];
    }

    public function laporans()
    {
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }

    public function hubungan()
    {
        return $this->belongsTo('App\Models\HubunganKeluargaKlien', 'hubungan_id', 'id');
    }

    public function satgas(){
        return $this->belongsTo('App\Models\User','satgas_id','id');
    }

}