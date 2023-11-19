<?php

namespace App\Models;

use App\Http\Resources\AgamaResource;
use App\Http\Resources\DetailKlien\BpjsResource;
use App\Http\Resources\DetailKlien\PekerjaanResource;
use App\Http\Resources\DetailKlien\StatusPerkawinanResource;
use App\Http\Resources\UserResource;
use App\Models\ModelUtils;
use App\Repositories\DetailKlienRepository;
use App\Services\DetailKlienService;
use App\Http\Resources\DetailKlienResource;
use App\Http\Resources\KecamatansResource;
use App\Http\Resources\KelurahansResource;
use App\Http\Resources\KotaResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PDO;

class DetailKlien extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'warga_surabaya',
        'kota_id',
        'kecamatan_id',
        'no_kk',
        'no_wa',
        'alamat_kk',
        'kecamatan_kk_id',
        'kelurahan_kk_id',
        'kota_lahir_id',
        'tanggal_lahir',
        'agama_id',
        'kategori_klien',
        'jenis_klien',
        'pekerjaan_id',
        'penghasilan_bulanan',
        'status_perkawinan_id',
        'bpjs_id',
        'pendidikan_kelas',
        'pendidikan_instansi',
        'pendidikan_jurusan',
        'pendidikan_thn_lulus',
        'satgas_id'
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        $rules = [
            'laporan_id' => 'required|exists:laporans,id',
            'warga_surabaya' => 'nullable|boolean',
            'kota_id' => 'nullable|exists:kotas,id',
            'kecamatan_id' => 'nullable|exists:kecamatans,id',
            'no_kk' => 'nullable|string',
            'alamat_kk' => 'nullable|string',
            'kecamatan_kk_id' => 'nullable|exists:kecamatans,id',
            'kelurahan_kk_id' => 'nullable|exists:kelurahans,id',
            'kota_lahir_id' => 'nullable|exists:kotas,id',
            'tanggal_lahir' => 'nullable|date',
            'agama_id' => 'nullable|exists:agama,id',
            'kategori_klien' => 'nullable|in:anak,dewasa',
            'jenis_klien' => 'nullable|in:umum,disabilitas',
            'pekerjaan_id' => 'nullable|exists:pekerjaans,id',
            'penghasilan_bulanan' => 'nullable|integer',
            'status_perkawinan_id' => 'nullable|exists:status_perkawinans,id',
            'bpjs_id' => 'nullable|exists:bpjs,id',
            'pendidikan_kelas' => 'nullable|string',
            'pendidikan_instansi' => 'nullable|string',
            'pendidikan_jurusan' => 'nullable|string',
            'pendidikan_thn_lulus' => 'nullable|string|max:4',
            'no_wa' => 'nullable|string|max:12',
            'satgas_id' => 'required|exists:users,id'
        ];
        return ModelUtils::rulesPatch($rules);
    }

    /**
     * Messages that applied in this model
     *
     * @var array
     */
    public static function validationMessages()
    {
        return [
            'no_wa.string' => 'Nomor telepon atau nomor wa hanya boleh string',
            'no_wa.max' => 'Nomor telepon atau nomor wa maksimal memiliki panjang 12 character',
            'kategori_klien.in' => 'Kategori klien hanya bisa : anak, dewasa',
            'jenis_klien.in' => 'Jenis klien hanya bisa umum atau disabilitas',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $tanggal_lahir = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir);
        $usia = $tanggal_lahir->diffInYears(\Carbon\Carbon::now());

        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama_klien' => $request->laporans->nama_klien,
            'nik_klien' => $request->laporans->nik_klien,
            'alamat_klien' => $request->laporans->alamat_klien,
            'laporan_id' => $request->laporan_id,
            'warga_surabaya' => $request->warga_surabaya,
            'kota' => $request->kota ? new KotaResource($request->kota) : null,
            'kecamatan' => $request->kecamatan ? new KecamatansResource($request->kecamatan) : null,
            'no_kk' => $request->no_kk,
            'no_wa' => $request->no_wa,
            'alamat_kk' => $request->alamat_kk,
            'kecamatan_kk' => $request->kecamatan_kk ? new KecamatansResource($request->kecamatan_kk) : null,
            'kelurahan_kk' => $request->kelurahan_kk ? new KelurahansResource($request->kelurahan_kk) : null,
            'kota_lahir' => $request->kota_lahir ? new KelurahansResource($request->kota_lahir) : null,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama ? new AgamaResource($request->agama) : null,
            'usia' => $usia, 
            'kategori_klien' => $request->kategori_klien,
            'jenis_klien' => $request->jenis_klien,
            'pekerjaan' => $request->pekerjaan ? new PekerjaanResource($request->pekerjaan) : null,
            'penghasilan_bulanan' => (int) $request->penghasilan_bulanan,
            'status_perkawinan' => $request->status_perkawinan ? new StatusPerkawinanResource($request->status_perkawinan) : null,
            'bpjs' => $request->bpjs_rel ? new BpjsResource($request->bpjs_rel) : null,
            'pendidikan_kelas' => $request->pendidikan_kelas,
            'pendidikan_instansi' => $request->pendidikan_instansi,
            'pendidikan_jurusan' => $request->pendidikan_jurusan,
            'pendidikan_thn_lulus' => $request->pendidikan_thn_lulus,
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
        return 'App\Http\Controllers\DetailKlienController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new DetailKlienService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new DetailKlienRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new DetailKlienResource($this);
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
            'kota',
            'kecamatan_kk',
            'kecamatan',
            'kelurahan_kk',
            'kota_lahir',
            'satgas',
            'agama',
            'pekerjaan',
            'status_perkawinan',
            'bpjs_rel'
        ];
    }

    public function kota(){
        return $this->belongsTo('App\Models\Kota','kota_id','id');
    }

    public function kecamatan_kk(){
        return $this->belongsTo('App\Models\Kecamatans','kecamatan_kk_id','id');
    }

    public function kecamatan(){
        return $this->belongsTo('App\Models\Kecamatans','kecamatan_id','id');
    }

    public function kelurahan_kk(){
        return $this->belongsTo('App\Models\Kelurahans', 'kelurahan_kk_id','id');
    }

    public function laporans()
    {
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }

    public function kota_lahir(){
        return $this->belongsTo('App\Models\Kota','kota_lahir_id','id');
    }

    public function satgas(){
        return $this->belongsTo('App\Models\User','satgas_id','id');
    }

    public function agama(){
        return $this->belongsTo('App\Models\Agama','agama_id','id');
    }

    public function pekerjaan(){
        return $this->belongsTo('App\Models\DetailKlien\Pekerjaan','pekerjaan_id','id');
    }

    public function status_perkawinan(){
        return $this->belongsTo('App\Models\DetailKlien\StatusPerkawinan','status_perkawinan_id','id');
    }

    public function bpjs_rel(){
        return $this->belongsTo('App\Models\DetailKlien\Bpjs','bpjs_id','id');
    }
}