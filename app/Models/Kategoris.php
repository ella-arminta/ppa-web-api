<?php

namespace App\Models;

use App\Http\Resources\DetailKlien\KategoriKasusResource;
use App\Models\ModelUtils;
use App\Models\Laporans;
use App\Repositories\KategorisRepository;
use App\Services\KategorisService;
use App\Http\Resources\KategorisResource;
use App\Http\Resources\LaporansResource;
use App\Models\DetailKlien\KategoriKasus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kategoris extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama'
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'nama' => 'required',
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
            'nama.required' => 'Nama tidak boleh kosong',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withLaporans = ModelUtils::checkParam(request('withLaporans'));
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'laporans' => $withLaporans ? LaporansResource::collection($request->laporans) : null,
            'kategori_kasus' => KategoriKasusResource::collection($request->kategori_kasus)
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\KategorisController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KategorisService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KategorisRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KategorisResource($this);
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
            'kategori_kasus',
            'kategori_kasus.jenis_kasus'
        ];
    }

    public function laporans() {
        return $this->hasMany(Laporans::class, 'kategori_id', 'id');
    }

    public function kategori_kasus() {
        return $this->hasMany(KategoriKasus::class, 'kategori_id', 'id');
    }

}