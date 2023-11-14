<?php

namespace App\Services;

use App\Models\DokumenPendukung;
use App\Services\BaseService;

class DokumenPendukungService extends BaseService
{
    public function __construct(DokumenPendukung $model)
    {
        parent::__construct($model);
    }

    /*
        Add new services
        OR
        Override existing service here...
    */
    public function create($data) {

        $files = $this->model->getFillable();

        foreach ($files as $file) {
            if($file == 'laporan_id') continue;
            if (isset($data[$file])) {
                $data[$file] = $this->uploadFile($data[$file], 'dokumen_pendukung/'.$file);
            }
        }

        $data = $this->repository->create($data);

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