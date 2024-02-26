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

    public function getAllWithParam($filterParams = [], $filterRelatedParams = [])
    {
        $this->model = $this->model->with($this->model->relations());

        // example usage 
        // filterRelatedParams = [
        //     'detailKasus' => [
        //         'kategori_kasus_id' => 1,
        //         'jenis_kasus_id' => 1
        //     ],
        //     'detailKlien' => [
        //         'jenis_kelamin' => 'Laki-laki'
        //     ]
        // ]
        if (!empty($filterRelatedParams)) {
            foreach ($filterRelatedParams as $relations => $conditions) {
                $relation = array_keys($conditions)[0];
                $condition = array_values($conditions)[0];
                $this->model = $this->model->whereHas($relation, function ($query) use ($condition) {
                    foreach ($condition as $column => $value) {
                        $query->where($column, $value);
                    }
                });
            }
        }
        
        if (!empty($filterParams)) {
            $this->model = $this->model->where($filterParams);
        }
        return $this->model->get();
    }

    public function getById($id) {
        return $this->model->with($this->model->relations())->findOrFail($id);
        // return $this->model->findOrFail($id)->with($this->model->relations())->first();
    }

    public function getByLaporanId($id) {
        return $this->model->with($this->model->relations())->where('laporan_id', $id)->get();
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