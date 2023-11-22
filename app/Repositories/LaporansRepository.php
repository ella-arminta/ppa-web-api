<?php

namespace App\Repositories;

use App\Models\Laporans;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class LaporansRepository extends BaseRepository
{
    public function __construct(Laporans $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */

    public function getWithPaginate($params = null)
    {
        $data = $this->checkStatus($params);

        return $data->paginate(10);
    }

    public function getAll()
    {
        $data = $this->checkStatus();

        return $data->get();
    }

    public function getById($id) {
        return $this->model
        ->with($this->model->relations())
        ->withTrashed()
        ->findOrFail($id);
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);
        $model->status_id = 6;
        $model->save();
        $model->delete();
        // return $model;
    }

    public function getByToken($token) {
        return $this->model->where('token', $token)->withTrashed()->first();
    }

    private function checkStatus($params = null)
    {
        if (!is_null(request("status")) && (int)request('status') == 6) {
            return $this->model->onlyTrashed()
                ->with($this->model->relations())
                ->orderBy("updated_at", "DESC")
                ->klien($params)->role();
        }

        if (!is_null(request("status")) && (int)request('status') != 0) {
            return $this->model->with($this->model->relations())
                ->orderBy("updated_at", "DESC")
                ->klien($params)
                ->role()
                ->status((int)request("status"));
        }

        if(!is_null(request('kelurahan_id'))){
            return $this->model
            ->with($this->model->relations())
            ->orderBy("updated_at", "DESC")
            ->kelurahan(request('kelurahan_id'));
        }

        return $this->model
            ->with($this->model->relations())
            ->orderBy("updated_at", "DESC")
            ->klien($params)->role();
    }

    public function getCountByRtKategori() {
        $data = $this->model
        ->join('kategoris', 'laporans.kategori_id', '=', 'kategoris.id')
        ->select('laporans.rt', 'laporans.kategori_id', 'kategoris.nama', DB::raw('COUNT(*) as count'))
        ->groupBy('laporans.rt', 'laporans.kategori_id', 'kategoris.nama')
        ->get();

        return $data;
    }

    public function getRt(){
        $data = $this->model
                ->select('rt', DB::raw('COUNT(rt) as rt_count'))
                ->groupBy('rt')
                ->get();
        return $data;
    }
}

