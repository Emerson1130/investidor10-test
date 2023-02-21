<?php

namespace App\Repositories;

use App\Contracts\CRUDContract;
use App\Models\Post;
use App\Repositories\DatabaseBaseRepository;

class PostRepository extends DatabaseBaseRepository implements CRUDContract
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
    
    public function search(array $filters = [])
    {
        $query = $this->model;

        if (isset($filters['query']) && !empty($filters['query'])) {
            $query = $query->where('posts.title', 'like', '%' . $filters['query'] . '%')
                           ->orWhere('posts.body', 'like', '%' . $filters['query'] . '%');
        }
        
        $query->orderBy('posts.created_at', 'desc');

        return $query->paginate($this->limitPerPage);
    }
}
