<?php

namespace App\Models\DetailKlien;

use App\Http\Resources\DetailKlien\JenisKasusResource;
use App\Models\ModelUtils;
use App\Repositories\DetailKlien\KategoriKasusRepository;
use App\Services\DetailKlien\KategoriKasusService;
use App\Http\Resources\DetailKlien\KategoriKasusResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KategoriKasus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kategori_id'
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'nama' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id'
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
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'jenis_kasus' => JenisKasusResource::collection($request->jenis_kasus)
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\DetailKlien\KategoriKasusController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KategoriKasusService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KategoriKasusRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KategoriKasusResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'detail_kasus',
            'jenis_kasus',
            'kategori'
        ];
    }

    public function detail_kasus()
    {
        return $this->hasMany('App\Models\DetailKasus', 'kategori_kasus_id','id');
    }

    public function jenis_kasus()
    {
        return $this->hasMany('App\Models\DetailKlien\JenisKasus', 'kategori_kasus_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategoris', 'kategori_id', 'id');
    }
}