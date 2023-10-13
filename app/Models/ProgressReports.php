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
        $rules = [
            'laporan_id' => 'required|exists:laporans,id',
            'admin_id' => 'required|exists:users,id',
            'isi' => 'required|string|min:3',
            'is_menyerah' => 'boolean',
        ];
        return ModelUtils::rulesPatch($rules);
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
            'laporan_id.exists' => 'Laporan tidak ditemukan',
            'admin_id.required' => 'Admin tidak boleh kosong',
            'admin_id.exists' => 'Admin tidak ditemukan',
            'isi.required' => 'Isi tidak boleh kosong',
            'isi.string' => 'Isi harus berupa tulisan latin',
            'isi.min' => 'Isi minimal 3 karakter',
            'is_menyerah.boolean' => 'Is menyerah harus ya atau tidaks',
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        $withLaporan = ModelUtils::checkParam(request('withLaporan'));
        $withUser = ModelUtils::checkParam(request('withUser'));
        return ModelUtils::filterNullValues([
            'id' => $request->id,
            'isi' => $request->isi,
            'isMenyerah' => $request->is_menyerah,
            'tanggal' => $request->created_at,
            'laporan' => $withLaporan ? new LaporanResource($request->laporan) : null,
            'admin' => $withUser ? new UserResource($request->admin)  : null,
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
