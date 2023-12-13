<?php

namespace App\Services;

use App\Models\RRKK;
use App\Services\BaseService;

class RRKKService extends BaseService
{
    public function __construct(RRKK $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
    public function create($data) {
        if(isset($data['dokumen_pendukung'])){
            $data['dokumen_pendukung'] = $this->uploadFile($data['dokumen_pendukung'], 'rrkk');
        }

        $data = $this->repository->create($data);

        $data = new $this->resource($data);
        
        return $data;
    }

    public function update($id, $data) {
        if(isset($data['dokumen_pendukung']))
            $data['dokumen_pendukung'] = $this->uploadFile($data['dokumen_pendukung'], 'rrkk');
        
        $data = $this->repository->update($id, $data);
        $data = new $this->resource($data);
        return $data;
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
}