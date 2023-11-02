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

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        $rules = [
            'judul' => 'nullable',
            'no_telp_pelapor' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,9}$/',
            'no_telp_klien' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,9}$/',
            'tanggal_jam_pengaduan' => 'nullable|date_format:Y-m-d H:i:s',
            'uraian_singkat_masalah' => 'required',
            'nama_klien' => 'nullable|regex:/^[a-zA-Z ]*$/|min:3',
            'nama_pelapor' => 'required|regex:/^[a-zA-Z ]*$/|min:3',
            'usia' => 'nullable|numeric|min:1',
            'kategori_id' => 'required|numeric|min:1|exists:kategoris,id',
            'kelurahan_id' => 'required|numeric|min:1|exists:kelurahans,id',
            'alamat_pelapor' => 'nullable',
            'alamat_klien' => 'nullable',
            'rt' => 'nullable|min:1|max:3',
            'rw' => 'nullable|min:1|max:3',
            'nik_pelapor' => 'nullable',
            'nik_klien' => 'nullable',
            'jenis_kelamin' => 'nullable|in:L,P',
            'kronologis' => 'nullable',
            'sumber_pengaduan_id' => 'nullable|numeric|min:1|exists:sumber_pengaduans,id',
            'pendidikan_id' => 'nullable|numeric|min:1|exists:pendidikans,id',
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
            'nama_klien.required' => 'Nama klien tidak boleh kosong',
            'nama_klien.regex' => 'Nama klien tidak valid',
            'nama_klien.min' => 'Nama klien minimal 3 karakter',
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
            'rt.required' => 'RT tidak boleh kosong',
            'rt.min' => 'RT tidak valid',
            'rt.max' => 'RT tidak valid',
            'rw.required' => 'RW tidak boleh kosong',
            'rw.min' => 'RW tidak valid',
            'rw.max' => 'RW tidak valid',
            'kronologis.required' => 'Kronologis tidak boleh kosong',
            'tanggal_jam_pengaduan.format' => 'Tanggal pengaduan tidak valid',
            'uraian_singkat_masalah.required' => 'Uraian singkat masalah tidak boleh kosong',
            'nik_pelapor.required' => 'NIK pelapor tidak boleh kosong',
            'nik_klien.required' => 'NIK klien tidak boleh kosong',
            'nik_pelapor.regex' => 'NIK pelapor tidak valid',
            'nik_klien.regex' => 'NIK klien tidak valid',
            'nik_pelapor.min' => 'NIK pelapor minimal 16 karakter',
            'nik_klien.min' => 'NIK klien minimal 16 karakter',
            'nik_pelapor.max' => 'NIK pelapor maksimal 16 karakter',
            'nik_klien.max' => 'NIK klien maksimal 16 karakter',
            'no_telp_klien.required' => 'Nomor telepon klien tidak boleh kosong',
            'no_telp_klien.regex' => 'Nomor telepon klien tidak valid',
            'alamat_pelapor.required' => 'Alamat pelapor tidak boleh kosong',
            'alamat_klien.required' => 'Alamat klien tidak boleh kosong',
            'pendidikan_id.required' => 'Pendidikan tidak boleh kosong',
            'pendidikan_id.numeric' => 'Pendidikan harus berupa angka',
            'pendidikan_id.min' => 'Pendidikan tidak valid',
            'pendidikan_id.exists' => 'Pendidikan tidak valid',
            'sumber_pengaduan_id.required' => 'Sumber pengaduan tidak boleh kosong',
            'sumber_pengaduan_id.numeric' => 'Sumber pengaduan harus berupa angka',
            'sumber_pengaduan_id.min' => 'Sumber pengaduan tidak valid',
            'sumber_pengaduan_id.exists' => 'Sumber pengaduan tidak valid',
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
            'nama_pelapor' => $request->nama_pelapor,
            'inisial_klien' => $request->inisial_klien,
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
            'alamat',
            'kategori',
            'status',
            'pendidikan',
            'satgas_pelapor',
            'previous_satgas',
            'kelurahan',
            'sumber_pengaduan',
            'kelurahan.kecamatan'
        ];
    }

    public function scopeKlien($query, $value=null) {
        $result = $query->whereRaw('LOWER(nama_klien) LIKE ?', ["%".strtolower($value)."%"])
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

    public function sumber_pengaduan()
    {
        return $this->belongsTo('App\Models\SumberPengaduan', 'sumber_pengaduan_id', 'id');
    }
}
