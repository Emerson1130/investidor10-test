<?php

namespace App\Factories;

use App\Models\Book;

class BookFactory
{

    public function create(array $data)
    {
        return new Book([
            'name' => $data['name'],
            'isbn' => $data['isbn'],
            'value' => $data['value'],
            'user_id' => $data['user_id'],
        ]);
    }

}
