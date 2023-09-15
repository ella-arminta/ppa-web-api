<?php

namespace App\Models;

use App\Http\Resources\API\LaporanResource;
use App\Models\ModelUtils;
use App\Repositories\ProgressReportsRepository;
use App\Services\ProgressReportsService;
use App\Http\Resources\ProgressReportsResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProgressReports extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_id',
        'admin_id',
        'isi',
        'is_menyerah',
    ];

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'laporan_id' => 'required',
            'admin_id' => 'required',
            'isi' => 'required',
            // 'is_menyerah' => 'required',
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
            'laporan_id.required' => 'Laporan tidak boleh kosong',
            'admin_id.required' => 'Admin tidak boleh kosong',
            'isi.required' => 'Isi tidak boleh kosong',
            // 'is_menyerah.required' => 'Is menyerah tidak boleh kosong',
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
            'isi' => $request->isi,
            'isMenyerah' => $request->is_menyerah,
            'laporan' => new LaporanResource($request->laporan),
            'admin' => new UserResource($request->admin),
        ]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\ProgressReportsController';
    }

    /**
     * Service associated with this model
     *
     * @var object Service
     */
    public function service()
    {
        return new ProgressReportsService($this);
    }

    /**
     * Repository associated with this model
     *
     * @var object Repository
     */
    public function repository()
    {
        return new ProgressReportsRepository($this);
    }

    /**
     * Resource associated with this model
     *
     * @var object Resource
     */

    public function resource()
    {
        return new ProgressReportsResource($this);
    }

    /**
     * Relations associated with this model
     *
     * @var array
     */
    public function relations()
    {
        return [
            'laporan',
        ];
    }

    public function laporan()
    {
        return $this->belongsTo('App\Models\Laporans', 'laporan_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\User', 'admin_id', 'id');
    }
}
