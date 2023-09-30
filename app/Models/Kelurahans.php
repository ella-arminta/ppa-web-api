<?php

namespace App\Models;

use App\Models\Kecamatans;
use App\Models\Alamats;
use App\Models\ModelUtils;

use App\Repositories\KelurahansRepository;
use App\Services\KelurahansService;
use App\Http\Resources\KelurahansResource;

use App\Http\Resources\KecamatansResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kelurahans extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kecamatan_id',
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
            'kecamatan_id' => 'required'
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
            'nama.required' => 'Nama Kelurahan tidak boleh kosong',
            'kecamatan_id.required' => 'Kecamatan tidak boleh kosong'
        ];
    }

    public function test()
    {
        return [
            'nama' => str()->random(5),
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withKecamatan = ModelUtils::checkParam(request('withKecamatan'));
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'nama' => $request->nama,
            'kecamatan' => $withKecamatan ? new KecamatansResource($request->kecamatan) : null,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\KelurahansController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new KelurahansService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new KelurahansRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new KelurahansResource($this);
    }

    /**
     * Relations associated with this model
     *
     * @var array
     */
    public function relations()
    {
        return [
            'kecamatan',
            'alamats'
        ];
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatans::class, 'kecamatan_id', 'id');
    }

    public function alamats()
    {
        return $this->hasMany(Alamats::class, 'kelurahan_id', 'id');
    }
}
