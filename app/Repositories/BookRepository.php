<?php

namespace App\Repositories;

use App\Contracts\CRUDContract;
use App\Models\Book;
use App\Repositories\DatabaseBaseRepository;

class BookRepository extends DatabaseBaseRepository implements CRUDContract
{

    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

}
