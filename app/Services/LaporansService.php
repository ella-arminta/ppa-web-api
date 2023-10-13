<?php

namespace App\Services;

use App\Models\Laporans;
use App\Models\Kronologis;
use App\Services\BaseService;

use App\Models\User;

class LaporansService extends BaseService
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        $kronologis = $data['kronologis'] ?? null;
        unset($data['kronologis']);

        $data['status_id'] = 1;
        $data['token'] = strtoupper(str()->random(8));
        
        if (!auth()->user()) {
            $admin = User::where('role_id', 2)->first()->id;
            $data['satgas_pelapor_id'] = $admin;
            $data['previous_satgas_id'] = $admin;
        }

        $data = $this->repository->create($data);        
        $data = $data->fresh();

        if (isset($kronologis)) {
            $this->saveKronologis($kronologis, $data->id, $data->satgas_pelapor_id);
        }
        
        $data = new $this->resource($data->fresh());

        return $data;
    }

    private function saveKronologis($kronologis, $laporan_id, $satgas_pelapor_id)
    {
        $k = new Kronologis();
        $repository = $k->repository();

        foreach ($kronologis as $k) {
            $k['laporan_id'] = $laporan_id;
            $k['admin_id'] = $satgas_pelapor_id;
            $repository->create($k);
        }
    }

    /*
    Add new services
    OR
    Override existing service here...
    */
}
