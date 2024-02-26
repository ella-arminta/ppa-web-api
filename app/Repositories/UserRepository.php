<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /*
        Add new repositories
        OR
        Override existing repository here...
    */

    public function getAll(){
        $data = $this->getAllFilter();

        return $data->get();
    }

    public function getAllFilter(){
        if(!is_null(request('kelurahan_id'))){
            return $this->model
            ->with($this->model->relations())
            ->orderBy("updated_at", "DESC")
            ->kelurahan(request('kelurahan_id'));
        }

        return $this->model->with($this->model->relations())->orderBy("id", "ASC")->get()->first();
    }
    
}