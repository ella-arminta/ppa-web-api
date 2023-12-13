<?php

namespace App\Models;

use App\Http\Resources\AgamaResource;
use App\Http\Resources\DetailKlien\StatusPerkawinanResource;
use App\Http\Resources\KotaResource;
use App\Models\ModelUtils;
use App\Repositories\PelakuRepository;
use App\Services\PelakuService;
use App\Http\Resources\PelakuResource;
use App\Http\Resources\PendidikansResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Pelaku extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'nama_lengkap',
        'hubungan',
        // 'usia',
        'satgas_id',
        'nik',
        'no_kk',
        'kota_lahir_id',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama_id',
        'pendidikan_id',
        'pekerjaan',
        'status_perkawinan_id',
        'alamat_kk',
        'alamat_domisili',
        'kewarganegaraan',
        'no_telp',
        'hubungan_dengan_klien',
        'usia'
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
            'nama_lengkap' => 'required|string',
            'hubungan' => 'nullable|string',
            'satgas_id' => 'required|exists:users,id',
            'nik' => 'nullable|string',
            'no_kk' => 'nullable|string',
            'kota_lahir_id' => 'nullable|exists:kota,id',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama_id' => 'nullable|exists:agama,id',
            'pendidikan_id' => 'nullable|exists:pendidikan,id',
            'pekerjaan' => 'nullable|string',
            'status_perkawinan_id' => 'nullable|exists:status_perkawinan,id',
            'alamat_kk' => 'nullable|string',
            'alamat_domisili' => 'nullable|string',
            'kewarganegaraan'  => 'nullable|string',
            'no_telp' => 'nullable|string',
            'hubungan_dengan_klien' => 'nullable|string',
            'usia' => 'nullable|integer'
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

        // $usia = $request->tanggal_lahir ? Carbon::parse($request->tanggal_lahir)->age : null;
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'laporan_id' => $request->laporan_id,
            'nama_lengkap' => $request->nama_lengkap,
            'hubungan' => $request->hubungan,
            'usia' => $request->usia,
            'satgas' => $request->satgas ? new UserResource($request->satgas) : null,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'kota_lahir' => $request->kota_lahir ? new KotaResource($request->kota_lahir) : null,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama ? new AgamaResource($request->agama) : null,
            'pendidikan' => $request->pendidikan ? new PendidikansResource($request->pendidikan) : null,
            'pekerjaan' => $request->pekerjaan,
            'status_perkawinan' => $request->status_perkawinan ? new StatusPerkawinanResource($request->status_perkawinan) : null,
            'alamat_kk' => $request->alamat_kk,
            'alamat_domisili' => $request->alamat_domisili,
            'kewarganegaraan' => $request->kewarganegaraan,
            'no_telp' => $request->no_telp,
            'hubungan_dengan_klien' => $request->hubungan_dengan_klien,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\PelakuController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new PelakuService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new PelakuRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new PelakuResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'laporan',
            'satgas',
            'kota_lahir',
            'agama',
            'pendidikan',
            'status_perkawinan'
        ];
    }
    
    public function laporan()
    {
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }

    public function satgas(){
        return $this->belongsTo('App\Models\User','satgas_id','id');
    }

    public function kota_lahir(){
        return $this->belongsTo('App\Models\Kota','kota_lahir_id','id');
    }

    public function agama(){
        return $this->belongsTo('App\Models\Agama','agama_id','id');
    }

    public function pendidikan(){
        return $this->belongsTo('App\Models\Pendidikans','pendidikan_id','id');
    }

    public function status_perkawinan(){
        return $this->belongsTo('App\Models\DetailKlien\StatusPerkawinan','status_perkawinan_id','id');
    }
}