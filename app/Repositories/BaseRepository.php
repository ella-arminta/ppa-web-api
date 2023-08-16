<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->all();
    }

    public function getById($id) {
        return $this->model->findOrFail($id);
    }

    public function create($data) {
        return $this->model->create($data);
    }
    
    public function update($id, $data) {
        $model = $this->model->find($id);
        $model->update($data);
        return $model->fresh();
    }

    public function delete($id) {
        $model = $this->model->find($id);
        $model->delete();
        return $model;
    }
}