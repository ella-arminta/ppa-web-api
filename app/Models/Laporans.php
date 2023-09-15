<?php

namespace App\Models;

use App\Http\Resources\AlamatsResource;
use App\Http\Resources\API\KategoriResource;
use App\Http\Resources\KategorisResource;
use App\Http\Resources\KronologisResource;
use App\Models\ModelUtils;
use App\Repositories\LaporansRepository;
use App\Services\LaporansService;
use App\Http\Resources\LaporansResource;
use App\Http\Resources\ProgressReportsResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Laporans extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'no_telp_pelapor',
        'nama_korban',
        'nama_pelapor',
        'usia',
        'kategori_id',
        'alamat_id',
        'pendidikan_id',
        'jenis_kelamin',
        'satgas_pelapor_id',
        'previous_satgas_id',
        'status_id',
        'token',
        'pendidikan_id',
    ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'judul' => 'required',
            'no_telp_pelapor' => 'required',
            'nama_korban' => 'required',
            'nama_pelapor' => 'required',
            'usia' => 'required',
            'kategori_id' => 'required',
            'alamat_id' => 'required',
            'jenis_kelamin' => 'required',
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
            'judul.required' => 'Judul tidak boleh kosong',
            'no_telp_pelapor.required' => 'Nomor telepon pelapor tidak boleh kosong',
            'nama_korban.required' => 'Nama korban tidak boleh kosong',
            'nama_pelapor.required' => 'Nama pelapor tidak boleh kosong',
            'usia.required' => 'Usia tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'alamat_id.required' => 'Alamat tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
        ];
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
            'judul' => $request->judul,
            'noTelpPelapor' => $request->no_telp_pelapor,
            'namaKorban' => $request->nama_korban,
            'namaPelapor' => $request->nama_pelapor,
            'usia' => $request->usia,
            'kategori' => new KategorisResource($request->kategori),
            'alamat' => new AlamatsResource($request->alamat),
            'jenisKelamin' => $request->jenis_kelamin,
            'kronologis' => KronologisResource::collection($request->kronologis),
            'progress_reports' => ProgressReportsResource::collection($request->progress_reports),
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\LaporansController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new LaporansService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new LaporansRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new LaporansResource($this);
    }

    /**
     * Relations associated with this model
     *
     * @var array
     */
    public function relations()
    {
        return [
            'kronologis',
            'alamat',
            'progress_reports',
            'kategori',
            'status',
            'pendidikan',
            'user',
        ];
    }

    public function alamat()
    {
        return $this->belongsTo('App\Models\Alamats', 'alamat_id', 'id');
    }

    public function kronologis()
    {
        return $this->hasMany('App\Models\Kronologis', 'laporan_id', 'id');
    }

    public function progress_reports()
    {
        return $this->hasMany('App\Models\ProgressReports', 'laporan_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategoris', 'kategori_id', 'id');
    }

    public function satgas_pelapor()
    {
        return $this->belongsTo('App\Models\User', 'satgas_pelapor_id', 'id');
    }

    public function previous_satgas()
    {
        return $this->belongsTo('App\Models\User', 'previous_satgas_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Statuses', 'status_id', 'id');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\Models\Pendidikans', 'pendidikan_id', 'id');
    }
}
