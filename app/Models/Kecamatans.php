<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Models\Kelurahans;

use App\Repositories\KecamatansRepository;
use App\Services\KecamatansService;
use App\Http\Resources\KecamatansResource;
use App\Http\Resources\KelurahansResource;
use App\Http\Resources\WilayahResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kecamatans extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'wilayah_id'
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
            'wilayah_id' => 'nullable|exists:wilayah,id'
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
            'nama.required' => 'Nama Kecamatan tidak boleh kosong',
            'wilayah_id.exists' => 'Wilayah tidak ditemukan'
        ];
    }

    public function test()
    {
        return [
            'nama' => 'Kecamatan ' . str()->random(10),
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withKelurahans = ModelUtils::checkParam(request('withKelurahans'));
        $withWilayah = ModelUtils::checkParam(request('withWilayah'));
        
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'kelurahans' => $withKelurahans ? KelurahansResource::collection($request->kelurahans) : null,
            'wilayah' => $withWilayah ? new WilayahResource($request->wilayah) : null,
        ]);
    }

    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\KecamatansController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KecamatansService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KecamatansRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KecamatansResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['kelurahans','wilayah'];
    }

    public function kelurahans() {
        return $this->hasMany(Kelurahans::class, 'kecamatan_id', 'id');
    }

    public function wilayah() {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'id');
    }

}