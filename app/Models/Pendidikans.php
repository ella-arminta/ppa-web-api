<?php

namespace App\Models;

use App\Http\Resources\LaporansResource;
use App\Models\ModelUtils;
use App\Repositories\PendidikansRepository;
use App\Services\PendidikansService;
use App\Http\Resources\PendidikansResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pendidikans extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
    ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'nama' => [
                'required',
                'string',
            ],
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
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
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
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\PendidikansController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new PendidikansService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new PendidikansRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new PendidikansResource($this);
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
        ];
    }

    public function laporans() {
        return $this->hasMany('App\Models\Laporans', 'pendidikan_id', 'id');        
    }

}