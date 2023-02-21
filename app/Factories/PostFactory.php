<?php

namespace App\Factories;

use App\Models\Post;

class PostFactory
{
    public function create(array $data)
    {
        return new Post([
            'title' => $data['title'],
            'body' => $data['body'],
            'category' => $data['category'],
            'user_id' => $data['user_id'],
        ]);
    }
}
