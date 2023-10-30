<?php

namespace App\Models;

use App\Http\Resources\KecamatansResource;
use App\Models\ModelUtils;
use App\Repositories\WilayahRepository;
use App\Services\WilayahService;
use App\Http\Resources\WilayahResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Wilayah extends Model
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
            'nama' => 'required'
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
            'nama.required' => 'Nama Wilayah tidak boleh kosong'
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withKecamatans = ModelUtils::checkParam(request('withKecamatans'));
        
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'kecamatans' => $withKecamatans ? KecamatansResource::collection($request->kecamatans) : null,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\WilayahController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new WilayahService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new WilayahRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new WilayahResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'kecamatans',
        ];
    }

    public function kecamatans() {
        return $this->hasMany(Kecamatan::class, 'wilayah_id', 'id');
    }

}