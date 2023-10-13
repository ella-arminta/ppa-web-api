<?php

namespace App\Services;

use App\Models\Laporans;
use App\Models\Kronologis;
use App\Services\BaseService;

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
