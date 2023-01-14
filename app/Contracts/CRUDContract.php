<?php

namespace App\Contracts;

use App\Contracts\DomainModel;

interface CRUDContract
{

    public function store(DomainModel $book);

    public function update(DomainModel $book);

    public function destroy(DomainModel $model);

    public function find(int $id);
}
