<?php

namespace App\Contracts;

use App\Contracts\DomainModel;

interface CRUDContract
{
    public function store(DomainModel $model);

    public function update(DomainModel $model);

    public function destroy(DomainModel $model);

    public function find(int $id);
}
