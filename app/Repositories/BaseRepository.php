<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->with($this->model->relations())->orderBy("id", "ASC")->get();
    }

    public function getById($id) {
        return $this->model->with($this->model->relations())->findOrFail($id);
        // return $this->model->findOrFail($id)->with($this->model->relations())->first();
    }

    public function create($data) {
        return $this->model->create($data);
    }
    
    public function update($id, $data) {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model->fresh();
    }

    public function delete($id) {
        $model = $this->model->findOrFail($id);
        $model->delete();
        // return $model;
    }
}