<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\KotaRepository;
use App\Services\KotaService;
use App\Http\Resources\KotaResource;
use App\Http\Resources\WilayahResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kota extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'kotas';
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
            'nama' => 'required|string'
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
            'nama.string' => 'Nama harus berupa tulisan'
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withWilayahs = ModelUtils::checkParam(request('withWilayahs'));
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'wilayahs' => $withWilayahs ? WilayahResource::collection($request->wilayahs) : null,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\KotaController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KotaService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KotaRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KotaResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'wilayahs'
        ];
    }

    public function wilayahs() {
        return $this->hasMany(Wilayah::class, 'kota_id', 'id');
    }

}