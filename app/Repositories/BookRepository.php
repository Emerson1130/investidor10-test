<?php

namespace App\Repositories;

use App\Contracts\CRUDContract;
use App\Models\Book;

class BookRepository implements CRUDContract
{

    public function store(Book $book)
    {
        return $book->save();
    }

}
