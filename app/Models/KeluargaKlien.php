<?php

namespace App\Models;

use App\Http\Resources\API\LaporanResource;
use App\Http\Resources\DetailKlienResource;
use App\Models\ModelUtils;
use App\Repositories\KeluargaKlienRepository;
use App\Services\KeluargaKlienService;
use App\Http\Resources\KeluargaKlienResource;
use App\Http\Resources\KotaResource;
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
        'hubungan',
        'laporan_id',
        'nama_lengkap',
        'nik',
        'no_kk',
        'no_wa',
        'alamat_kk',
        'alamat_domisili',
        'pekerjaan',
        'sifat_pekerjaan',
        'penghasilan',
        'agama',
        'kota_lahir_id',
        'tanggal_lahir',
        'bpjs'
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
            'hubungan' => 'nullable|string|in:Suami,Istri,Anak Kandung,Ayah Kandung,Ibu Kandung,Saudara',
            'nama_lengkap' => 'nullable|string',
            'nik' => 'nullable|string',
            'no_kk' => 'nullable|string',
            'no_wa' => 'nullable|string',
            'alamat_kk' => 'nullable|string',
            'alamat_domisili' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'sifat_pekerjaan' => 'nullable|string',
            'penghasilan' => 'nullable|integer',
            'agama' => 'nullable|in:Islam,Kristen,Katholik,Buddha,Khonghucu,Hindu,Yang lain',
            'kota_lahir_id' => 'nullable|integer',
            'tanggal_lahir' => 'nullable|date',
            'bpjs' => 'nullable|string'
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
            'hubungan' => $request->hubungan,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'no_wa' => $request->no_wa,
            'alamat_kk' => $request->alamat_kk,
            'alamat_domisili' => $request->alamat_domisili,
            'pekerjaan' => $request->pekerjaan,
            'sifat_pekerjaan' => $request->sifat_pekerjaan,
            'penghasilan' => $request->penghasilan,
            'agama' => $request->agama,
            'kota_lahir_id' => $request->kota ? new KotaResource($request->kota) : null,
            'tanggal_lahir' => $request->tanggal_lahir,
            'bpjs' => $request->bpjs,
            'laporan_id' => $request->laporan_id,
            'laporan' => $withLaporan ? new LaporanResource($request->laporans) : null,
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
            'kota',
            'laporans'
        ];
    }

    public function kota(){
        return $this->belongsTo('App\Models\Kota','kota_lahir_id','id');
    }

    public function laporans()
    {
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }
}