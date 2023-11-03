<?php

namespace App\Services;

use App\Http\Resources\LaporansResource;
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

    
    /*
    Add new services
    OR
    Override existing service here...
    */
    public function create($data)
    {
        $kronologis = $data['kronologis'] ?? null;
        unset($data['kronologis']);
    
        // if (env('APP_ENV') == 'local') {
        //     $data['status_id'] = 1;
        // } else if (env('APP_ENV') == 'production') {
        //     $data['status_id'] = 4;
        // } else {
        //     $data['status_id'] = 1;
        // }
        $data['status_id'] = 1;
        $data['token'] = strtoupper(str()->random(8));
        
        if (!auth()->user()) {
            $admin = User::where('role_id', 2)->first()->id;
            $data['satgas_pelapor_id'] = $admin;
            $data['previous_satgas_id'] = $admin;
        } else {
            $data['satgas_pelapor_id'] = auth()->user()->id;
            $data['previous_satgas_id'] = auth()->user()->id;
        }

        // $data['dokumentasi_pengaduan'] = $this->uploadFile($data['dokumentasi_pengaduan'], 'dokumentasi_pengaduan');
    
        $data = $this->repository->create($data);
    
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

    private function uploadFile($file, $folder)
    {
        $file = $file ?? null;
        if ($file) {
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->storePubliclyAs('storage/' . $folder, $file_name);
            return $file_name;
        }
        return null;
    }
    
    public function getByToken($token) {
        return new LaporansResource($token);
    }

    public function getAll() {
        $data = request('page') ? $this->repository->getWithPaginate(request('search')) : $this->repository->getAll();

        return $this->resource::collection($data);
    }
}
