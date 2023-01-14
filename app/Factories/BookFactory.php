<?php

namespace App\Factories;

use App\Models\Book;
use App\Contracts\DomainModel;

class BookFactory
{

    private DomainModel $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return new $this->model([
            'name' => $data['name'],
            'isbn' => $data['isbn'],
            'value' => $data['value'],
            'user_id' => $data['user_id'],
        ]);
    }

}
