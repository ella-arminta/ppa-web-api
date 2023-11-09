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

        $data['status_id'] = 1;
        $data['token'] = strtoupper(str()->random(8));

        $admin = User::where('role_id', 2)->first()->id;
        $data['satgas_pelapor_id'] = $admin;
        $data['previous_satgas_id'] = $admin;

        if (isset($data['dokumentasi_pengaduan'])) {
            $data['dokumentasi_pengaduan'] = $this->uploadFile($data['dokumentasi_pengaduan'], 'dokumentasi_pengaduan');
        }

        $data = $this->repository->create($data);

        if (isset($kronologis)) {
            $this->saveKronologis($kronologis, $data->id, $data->satgas_pelapor_id);
        }

        $data = new $this->resource($data->fresh());

        return $data;
    }

    public function update($id, $data)
    {
        $foreign = ['status', 'kategori', 'pendidikan', 'satgas pelapor', 'previous satgas'];

        foreach ($foreign as $f) {
            $d = str_replace(' ', '_', $f);
            if (isset($data[$d])) {
                $f = strtolower($f);
                $f = str_replace(' ', '_', $f);
                $data[$f . "_id"] = $data[$d]['id'];
                unset($data[$d]);
            }
        }

        $data = $this->repository->update($id, $data);
        $data = new $this->resource($data);
        return $data;
    }

    public function getByToken($token)
    {
        $token = $this->repository->getByToken($token);
        return new LaporansResource($token);
    }

    public function getAll()
    {
        $data = request('page') ? $this->repository->getWithPaginate(request('search')) : $this->repository->getAll();

        return $this->resource::collection($data);
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
        $file_value = [];
        if ($file) {
            foreach ($file as $f) {
                $extension = $f->getClientOriginalExtension();
                $file_name = str()->uuid() . '.' . $extension;
                $path = $f->storePubliclyAs('public/' . $folder, $file_name);
                $path = str_replace('public', 'storage', $path);
                $file_value[] = env('APP_DESTINATION') . $path;
            }
            return json_encode($file_value);
        }
        return null;
    }

    public function setStatusPenjangkauan($data){
        $data['jenis'] = 'status_'.$data['jenis'];
        $this->repository->update(
            $data['laporan_id'],
            [
                $data['jenis'] => $data['status']
            ]
        );
    }
}
