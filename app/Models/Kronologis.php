<?php

namespace App\Models;

use App\Http\Resources\UserResource;
use App\Models\ModelUtils;
use App\Models\Laporans;

use App\Repositories\KronologisRepository;
use App\Services\KronologisService;
use App\Http\Resources\KronologisResource;
use App\Http\Resources\LaporansResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kronologis extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'admin_id',
        'isi',
        'tanggal'
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
            'admin_id' => 'required|exists:users,id',
            'isi' => 'required|string|min:3',
            'tanggal' => 'nullable|date'
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
            'laporan_id.required' => 'Laporan tidak boleh kosong',
            'laporan_id.exists' => 'Laporan tidak ditemukan',
            'admin_id.required' => 'Admin tidak boleh kosong',
            'admin_id.exists' => 'Admin tidak ditemukan',
            'isi.required' => 'Isi tidak boleh kosong',
            'isi.string' => 'Isi harus berupa tulisan latin',
            'isi.min' => 'Isi minimal 3 karakter',
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
        $withUser = ModelUtils::checkParam(request('withUser'));
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'laporan' => $withLaporan ? new LaporansResource($request->laporan) : null,
            'admin' => $withUser ? new UserResource($request->admin)  : null,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\KronologisController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KronologisService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KronologisRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KronologisResource($this);
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
        ];
    }

    public function laporan()
    {
        return $this->belongsTo(Laporans::class, 'laporan_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\User', 'admin_id', 'id');
        /* 
        satgas_pelapor_id
        previous_satgas_id
        */
    }
}
