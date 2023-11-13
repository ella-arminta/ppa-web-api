<?php

namespace App\Models;

use App\Http\Resources\API\KategoriResource;
use App\Models\ModelUtils;
use App\Repositories\DetailKasusRepository;
use App\Services\DetailKasusService;
use App\Http\Resources\DetailKasusResource;
use App\Http\Resources\DetailKlien\JenisKasusResource;
use App\Http\Resources\DetailKlien\KategoriKasusResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DetailKasus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'kategori_kasus_id',
        'jenis_kasus_id',
        'lokasi_kasus',
        'tanggal_jam_kejadian'
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
            'kategori_kasus_id' => 'required|exists:kategori_kasuses,id',
            'jenis_kasus_id' => 'required|exists:jenis_kasuses,id',
            'lokasi_kasus' => 'required|string',
            'tanggal_jam_kejadian' => 'required|date_format:Y-m-d H:i:s'
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
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'laporan_id' => $request->laporan_id,
            'kategori_kasus' => $request->kategori_kasus ? new KategoriKasusResource($request->kategori_kasus) : null,
            'jenis_kasus' => $request->jenis_kasus ? new JenisKasusResource($request->jenis_kasus) : null,
            'lokasi_kasus' => $request->lokasi_kasus,
            'tanggal_jam_kejadian' => $request->tanggal_jam_kejadian
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\DetailKasusController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new DetailKasusService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new DetailKasusRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new DetailKasusResource($this);
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
            'kategori_kasus',
            'jenis_kasus'
        ];
    }

    public function laporan(){
        return $this->belongsTo(Laporans::class, 'laporan_id', 'id');
    }

    public function kategori_kasus()
    {
        return $this->belongsTo('App\Models\DetailKlien\KategoriKasus', 'kategori_kasus_id', 'id');
    }

    public function jenis_kasus(){
        return $this->belongsTo('App\Models\DetailKlien\JenisKasus', 'jenis_kasus_id', 'id');
    }

}