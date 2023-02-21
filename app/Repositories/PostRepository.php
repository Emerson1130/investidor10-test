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

}
