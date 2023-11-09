<?php 
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService {
    protected $model;
    protected $repository;
    protected $resource;

    public function __construct(Model $model) {
        $this->model = $model;
        $this->repository = $model->repository();
        $this->resource = $model->resource();
    }

    public function getAll() {
        $data = $this->repository->getAll();
        return $this->resource::collection($data);
    }

    public function getById($id) {
        $data = $this->repository->getById($id);

        return new $this->resource($data);
    }

    public function getByLaporanId($id) {
        $data = $this->repository->getByLaporanId($id);

        return new $this->resource($data);
    }

    public function create($data) {
        $data = $this->repository->create($data);

        $data = new $this->resource($data);
        
        return $data;
    }
    
    public function update($id, $data) {
        $data = $this->repository->update($id, $data);
        $data = new $this->resource($data);
        return $data;
    }
    
    public function delete($id) {
        $this->repository->delete($id);
        return true;
    }
}