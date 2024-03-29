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
            'kota_id_pelapor' => 'nullable|exists:kotas,id',
            'usia' => 'nullable|numeric|min:1',
            'kategori_id' => 'required|numeric|min:1|exists:kategoris,id',
            'kelurahan_id' => 'required|numeric|min:1|exists:kelurahans,id',
            'alamat_pelapor' => 'nullable',
            'alamat_klien' => 'nullable',
            'rt' => 'required|string|min:1|max:3',
            'rw' => 'required|string|min:1|max:3',
            'nik_pelapor' => 'nullable',
            'nik_klien' => 'nullable',
            'jenis_kelamin' => 'nullable|in:L,P',
            'kronologi_kejadian' => 'nullable',
            'sumber_pengaduan_id' => 'nullable|numeric|min:1|exists:sumber_pengaduans,id',
            'pendidikan_id' => 'nullable|numeric|min:1|exists:pendidikans,id',
            'dokumentasi_pengaduan' => 'nullable|array',
            'dokumentasi_pengaduan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'situasi_keluarga' => 'nullable|string',
            'kronologi_kejadian' => 'nullable|string',
            'harapan_klien_dan_keluarga' => 'nullable|string',
            'satgas_pelapor_id' => 'nullable|exists:users,id',
            // 'langkah_telah_dilakukan' => 'nullable|string',
            'status_keluarga' => 'nullable|integer|in:0,1,2',
            'status_detail_klien' => 'nullable|integer|in:0,1,2',
            'status_pelaku' => 'nullable|integer|in:0,1,2',
            'status_situasi_keluarga' => 'nullable|integer|in:0,1,2',
            'status_kronologi' => 'nullable|integer|in:0,1,2',
            'nomor_register' => 'nullable|string',
            'tanggal_penjangkauan' => 'nullable|date_format:Y-m-d H:i:s',
            
            'status_kondisi_klien' => 'nullable|integer|in:0,1,2',
            'status_langkah_telah_dilakukan' => 'nullable|integer|in:0,1,2',
            'status_rakk' => 'nullable|integer|in:0,1,2',
            'status_rrkk' => 'nullable|integer|in:0,1,2',
            'status_lintas_opd' => 'nullable|integer|in:0,1,2',

            'updated_at_keluarga' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_detail_klien' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_pelaku' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_situasi_keluarga' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_kronologi' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_kondisi_klien' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_langkah_telah_dilakukan' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_rakk' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_rrkk' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_lintas_opd' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_harapan' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at_dokumen_pendukung' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_by_keluarga' => 'nullable|exists:users,id',
            'updated_by_detail_klien' => 'nullable|exists:users,id',
            'updated_by_pelaku' => 'nullable|exists:users,id',
            'updated_by_situasi_keluarga' => 'nullable|exists:users,id',
            'updated_by_kronologi' => 'nullable|exists:users,id',
            'updated_by_kondisi_klien' => 'nullable|exists:users,id',
            'updated_by_langkah_telah_dilakukan' => 'nullable|exists:users,id',
            'updated_by_rakk' => 'nullable|exists:users,id',
            'updated_by_rrkk' => 'nullable|exists:users,id',
            'updated_by_lintas_opd' => 'nullable|exists:users,id',
            'updated_by_harapan' => 'nullable|exists:users,id',
            'updated_by_dokumen_pendukung' => 'nullable|exists:users,id',
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
            'kronologi_kejadian.required' => 'kronologi_kejadian tidak boleh kosong',
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
            'dokumentasi_pengaduan.required' => 'Dokumentasi pengaduan tidak boleh kosong',
            'dokumentasi_pengaduan.array' => 'Dokumentasi pengaduan harus berupa array',
            'dokumentasi_pengaduan.*.image' => 'Dokumentasi pengaduan harus berupa gambar',
            'dokumentasi_pengaduan.*.mimes' => 'Dokumentasi pengaduan harus berupa gambar',
            'dokumentasi_pengaduan.*.max' => 'Dokumentasi pengaduan maksimal 2MB',
            'status_keluarga' => 'Status Keluarga hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_detail_klien' => 'Status Keluarga hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_pelaku' => 'Status Keluarga hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_situasi_keluarga' => 'Status Situasi Keluarga hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_kronologi' => 'Status Kronologi hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_dokumen_pendukung' => 'Status Dokumen Pendukung hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',

            'status_kondisi_klien' => 'Status Kondisi Klien hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_langkah_telah_dilakukan' => 'Status Langkah Telah Dilakukan DP3A hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_rakk' => 'Status Rencana Analisis Kebutuhan Klien hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_rrkk' => 'Status Rencana Rujukan hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
            'status_lintas_opd' => 'Status Lintas OPD hanya boleh 0, 1 atau 2. (0 = blm input, 1 = draft, 2 = publish)',
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
        if (is_null(request('token')) && !str_contains(url()->current(), 'public') ) {
            $data = ModelUtils::addAttributeWithoutToken($request);
        }

        return ModelUtils::filterNullValues($data);
    }
    
    public function resourceDataPublic($request) {
        $data = [
            'id' => $request->id,
            'nama_pelapor' => $request->nama_pelapor,
            'inisial_klien' => $request->inisial_klien,
            'token' => $request->token,
            'status' => new StatusesResource($request->status),
            'kategori' => new KategorisResource($request->kategori),
            'created_at' => Carbon::parse($request->created_at)->format('d-m-Y'),
        ];

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
            'kelurahan.kecamatan',
            'detail_klien',
            'keluarga_klien',
            'pelaku',
            'kondisi_klien',
            'penjadwalan',
            'detail_kasus',
            'dokumen_pendukung',
            'kota_pelapor',
            'penanganan_awal',
            'langkah_telah_dilakukan',
            'RAKK',
            'RRKK',
            'lintas_opd',
            'updated_by_keluargas',
            'updated_by_detail_kliens',
            'updated_by_pelakus',
            'updated_by_situasi_keluargas' ,
            'updated_by_kronologis'  ,
            'updated_by_kondisi_kliens'  ,
            'updated_by_langkah_telah_dilakukans'  ,
            'updated_by_rakks' ,
            'updated_by_rrkks' ,
            'updated_by_lintas_opds' ,
            'updated_by_harapans',
            'updated_by_dokumen_pendukungs'
        ];
    }

    public function scopeKlien($query, $value=null) {
        $result = $query
        ->whereRaw('LOWER(nama_klien) LIKE ?', ["%".strtolower($value)."%"])
        ->orWhereRaw('LOWER(nama_pelapor) LIKE ?', ["%".strtolower($value)."%"])
        ->orWhereRaw('LOWER(nik_pelapor) LIKE ?', ["%".strtolower($value)."%"])
        ->orWhereRaw('LOWER(nik_klien) LIKE ?', ["%".strtolower($value)."%"]);

        return $result;
    }

    public function scopeStatus($query, $value) {
        return $query->where('status_id', $value);
    }

    public function scopeRole($query) {
        if (auth()->user()->role_id == 1) {
            return $query->where('satgas_pelapor_id', auth()->user()->id);
        }
        return $query->where('kelurahan_id', auth()->user()->kelurahan_id);
    }

    public function scopeKelurahan($query,$value){
        return $query->where('kelurahan_id',$value);
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

    public function kota_pelapor()
    {
        return $this->belongsTo('App\Models\Kota', 'kota_id_pelapor', 'id');
    }

    public function detail_klien()
    {
        return $this->hasOne('App\Models\DetailKlien', 'laporan_id', 'id');
    }

    public function keluarga_klien(){
        return $this->hasMany('App\Models\KeluargaKlien', 'laporan_id', 'id');
    }

    public function pelaku(){
        return $this->hasOne('App\Models\Pelaku','laporan_id','id');
    }

    public function kondisi_klien(){
        return $this->hasOne('App\Models\KondisiKlien','laporan_id','id');
    }

    public function penjadwalan(){
        return $this->hasOne('App\Models\Penjadwalan','laporan_id','id');
    }

    public function detail_kasus(){
        return $this->hasOne('App\Models\DetailKasus','laporan_id','id');
    }

    public function dokumen_pendukung(){
        return $this->hasOne('App\Models\DokumenPendukung','laporan_id','id');
    }

    public function penanganan_awal(){
        return $this->hasOne('App\Models\PenangananAwal','laporan_id','id');
    }

    public function langkah_telah_dilakukan(){
        return $this->hasMany('App\Models\LangkahTelahDilakukan','laporan_id','id');
    }

    public function RAKK(){
        return $this->hasMany('App\Models\RAKK','laporan_id','id');
    }

    public function RRKK(){
        return $this->hasMany('App\Models\RRKK','laporan_id','id');
    }

    public function lintas_opd(){
        return $this->hasMany('App\Models\LintasOPD','laporan_id','id');
    }

    public function updated_by_keluargas(){
        return $this->belongsTo('App\Models\User','updated_by_keluarga','id');
    }

    public function updated_by_detail_kliens(){
        return $this->belongsTo('App\Models\User','updated_by_detail_klien','id');
    }
    
    public function updated_by_pelakus(){
        return $this->belongsTo('App\Models\User','updated_by_pelaku','id');
    }

    public function updated_by_situasi_keluargas(){
        return $this->belongsTo('App\Models\User','updated_by_situasi_keluarga','id');
    }

    public function updated_by_kronologis(){
        return $this->belongsTo('App\Models\User','updated_by_kronologi','id');
    }

    public function updated_by_kondisi_kliens(){
        return $this->belongsTo('App\Models\User','updated_by_kondisi_klien','id');
    }

    public function updated_by_langkah_telah_dilakukans(){
        return $this->belongsTo('App\Models\User','updated_by_langkah_telah_dilakukan','id');
    }

    public function updated_by_rakks(){
        return $this->belongsTo('App\Models\User','updated_by_rakk','id');
    }

    public function updated_by_rrkks(){
        return $this->belongsTo('App\Models\User','updated_by_rrkk','id');
    }

    public function updated_by_lintas_opds(){
        return $this->belongsTo('App\Models\User','updated_by_lintas_opd','id');
    }

    public function updated_by_harapans(){
        return $this->belongsTo('App\Models\User','updated_by_harapan','id');
    }

    public function updated_by_dokumen_pendukungs(){
        return $this->belongsTo('App\Models\User','updated_by_dokumen_pendukung','id');
    }
}
