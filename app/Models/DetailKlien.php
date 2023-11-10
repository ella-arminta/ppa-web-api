<?php

namespace App\Models;

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
        'agama',
        'kategori_klien',
        'jenis_klien',
        'pekerjaan',
        'penghasilan_bulanan',
        'status_perkawinan',
        'bpjs',
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
            'agama' => 'nullable|in:Islam,Kristen,Katholik,Buddha,Khonghucu,Hindu,Yang lain',
            'kategori_klien' => 'nullable|string',
            'jenis_klien' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'penghasilan_bulanan' => 'nullable|integer',
            'status_perkawinan' => 'nullable|string|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'bpjs' => 'nullable|string',
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
            'agama.in' => 'Agama hanya boleh : Islam, Kristen, Katholik, Buddha, Khonghucu, Hindu, Yang lain.',
            'status_perkawinan.in' => 'Status Perkawinan hanya boleh : Belum Menikah, Menikah, Cerai Hidup, Cerai Mati',
            'no_wa.string' => 'Nomor telepon atau nomor wa hanya boleh string',
            'no_wa.max' => 'Nomor telepon atau nomor wa maksimal memiliki panjang 12 character'
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
            'agama' => $request->agama,
            'usia' => $usia, 
            'kategori_klien' => $request->kategori_klien,
            'jenis_klien' => $request->jenis_klien,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan_bulanan' => $request->penghasilan_bulanan,
            'status_perkawinan' => $request->status_perkawinan,
            'bpjs' => $request->bpjs,
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
            'satgas'
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

}