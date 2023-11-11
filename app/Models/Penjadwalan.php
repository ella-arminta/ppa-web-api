<?php

namespace App\Models;

use App\Models\ModelUtils;
use App\Repositories\PenjadwalanRepository;
use App\Services\PenjadwalanService;
use App\Http\Resources\PenjadwalanResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Penjadwalan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'tanggal_jam',
        'tempat',
        'alamat',
        'laporan_id'
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'tanggal_jam' => 'required|date_format:Y-m-d H:i:s',
            'tempat' => 'string|required',
            'alamat' => 'string|required',
            'laporan_id' => 'required|exists:laporans,id'
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
            'tanggal_jam.date_format' => 'Tanggal Format Y-m-d H:i:s',
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
            'laporan_id' => $request->laporan_id,
            'tanggal_jam' => $request->tanggal_jam,
            'tempat' => $request->tempat,
            'alamat' => $request->alamat,
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\PenjadwalanController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new PenjadwalanService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new PenjadwalanRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new PenjadwalanResource($this);
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'laporan'
        ];
    }

    public function laporan(){
        return $this->belongsTo('App\Models\Laporans','laporan_id','id');
    }

}