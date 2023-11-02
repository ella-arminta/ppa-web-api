<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\SumberPengaduanRepository;
use App\Services\SumberPengaduanService;
use App\Http\Resources\SumberPengaduanResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SumberPengaduan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sumber_pengaduans';
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
            'nama.required' => 'Nama Sumber Pengaduan tidak boleh kosong'
        ];
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
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\SumberPengaduanController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new SumberPengaduanService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new SumberPengaduanRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new SumberPengaduanResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'laporans'
        ];
    }

    public function laporans() {
        return $this->hasMany(Laporan::class, 'sumber_pengaduan_id', 'id');
    }

}