<?php

namespace App\Repositories;

use App\Contracts\DomainModel;

abstract class DatabaseBaseRepository
{

    protected DomainModel $model;

    public function __construct(DomainModel $model)
    {
        $this->model = $model;
    }

    protected function save(DomainModel $model)
    {
        return $model->save();
    }

    public function destroy(DomainModel $model)
    {
        return $model->delete();
    }

    public function store(DomainModel $model)
    {
        return $this->save($model);
    }

    public function update(DomainModel $model)
    {
        return $this->save($model);
    }

    public function find(int $id)
    {
        return $this->model::find($id);
    }

}
