<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Models\Kelurahans;

use App\Repositories\KecamatansRepository;
use App\Services\KecamatansService;
use App\Http\Resources\KecamatansResource;
use App\Http\Resources\KelurahansResource;
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
            'nama.required' => 'Nama Kecamatan tidak boleh kosong'
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
        
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'kelurahans' => $withKelurahans ? KelurahansResource::collection($request->kelurahans) : null,
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
        return ['kelurahans'];
    }

    public function kelurahans() {
        return $this->hasMany(Kelurahans::class, 'kecamatan_id', 'id');
    }

}