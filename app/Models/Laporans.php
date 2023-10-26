<?php

namespace App\Models;

use App\Http\Resources\KategorisResource;
use App\Http\Resources\LaporansResource;
use App\Http\Resources\StatusesResource;

use App\Models\ModelUtils;

use App\Repositories\LaporansRepository;

use App\Services\LaporansService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Laporans extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

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
        'alamat',
        'rt',
        'rw',
        'pendidikan_id',
        'jenis_kelamin',
        'satgas_pelapor_id',
        'previous_satgas_id',
        'status_id',
        'token',
        // 'pendidikan_id',
    ];

    // protected $hidden = [
    //     'updated_at',
    //     'deleted_at',
    // ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        $rules = [
            'judul' => 'required',
            'no_telp_pelapor' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,9}$/',
            'nama_korban' => 'required|regex:/^[a-zA-Z ]*$/|min:3',
            'nama_pelapor' => 'required|regex:/^[a-zA-Z ]*$/|min:3',
            'usia' => 'required|numeric|min:1',
            'kategori_id' => 'required|numeric|min:1|exists:kategoris,id',
            'alamat' => 'required',
            'rt' => 'required|min:1|max:3',
            'rw' => 'required|min:1|max:3',
            'jenis_kelamin' => 'required|in:L,P',
            'kronologis' => 'array|nullable',
            'kronologis.*.tanggal' => 'required|date',
            'kronologis.*.isi' => 'required',
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
            'judul.required' => 'Judul tidak boleh kosong',
            'no_telp_pelapor.required' => 'Nomor telepon pelapor tidak boleh kosong',
            'no_telp_pelapor.regex' => 'Nomor telepon pelapor tidak valid',
            'nama_korban.required' => 'Nama korban tidak boleh kosong',
            'nama_korban.regex' => 'Nama korban tidak valid',
            'nama_korban.min' => 'Nama korban minimal 3 karakter',
            'nama_pelapor.required' => 'Nama pelapor tidak boleh kosong',
            'nama_pelapor.regex' => 'Nama pelapor tidak valid',
            'nama_pelapor.min' => 'Nama pelapor minimal 3 karakter',
            'usia.required' => 'Usia tidak boleh kosong',
            'usia.numeric' => 'Usia harus berupa angka',
            'usia.min' => 'Usia minimal 1 tahun',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'kategori_id.numeric' => 'Kategori harus berupa angka',
            'kategori_id.min' => 'Kategori tidak valid',
            'kategori_id.exists' => 'Kategori tidak valid',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
            'kronologis.array' => 'Kronologis harus berupa array',
            'kronologis.*.tanggal.required' => 'Tanggal tidak boleh kosong',
            'kronologis.*.tanggal.date' => 'Tanggal tidak valid',
            'kronologis.*.isi.required' => 'Isi tidak boleh kosong',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $data = [
            'id' => $request->id,
            'token' => $request->token,
            'status' => new StatusesResource($request->status),
            'kategori' => new KategorisResource($request->kategori),
            'created_at' => Carbon::parse($request->created_at)->format('d-m-Y'),
        ];
        if (is_null(request('token'))) {
            $data = ModelUtils::addAttributeWithoutToken($request);
        }

        return ModelUtils::filterNullValues($data);
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
            'satgas_pelapor',
            'previous_satgas',
            'kelurahan',
            'kelurahan.kecamatan'
        ];
    }

    public function scopeKlien($query, $value=null) {
        $result = $query->whereRaw('LOWER(nama_korban) LIKE ?', ["%".strtolower($value)."%"])
        ->orWhereRaw('LOWER(nama_pelapor) LIKE ?', ["%".strtolower($value)."%"]);

        return $result;
    }

    public function scopeStatus($query, $value) {
        return $query->where('status_id', $value);
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

    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahans', 'kelurahan_id', 'id');
    }   
}
