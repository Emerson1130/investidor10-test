<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Factories\PostFactory;
use App\Exceptions\ResourceNotFoundException;
use App\Helpers\GlobalHelper;
use App\Validators\PostValidator;

class PostService
{
    private PostRepository $postRepository;
    private PostFactory $postFactory;
    private PostValidator $postValidator;

    public function __construct(
        PostRepository $postRepository,
        PostFactory $postFactory,
        PostValidator $postValidator,
    )
    {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        $this->postValidator = $postValidator;
    }
    
    public function get()
    {
        return $this->postRepository->get();
    }
    
    public function getSearchData(Request $request)
    {
        $query = $request->query('query');
        $posts = $this->postRepository->search([
            'query' => $query,
        ]);
        
        return [
            'logged_user_id' => GlobalHelper::getLoggedUserId($request),
            'posts' => $posts,
            'query' => $query
        ];
    }

    public function store(Request $request)
    {
        $model = $this->postFactory->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => GlobalHelper::getLoggedUserId($request)
        ]);

        $status = $this->postRepository->store($model);
        return ($status) ? $model->id : false;
    }

    public function update(int $id, Request $request)
    {
        $model = $this->postRepository->find($id);

        if (empty($model)) {
            throw new ResourceNotFoundException();
        }

        $this->postValidator->manipulation($model, $request);

        $model->title = $request->get('title');
        $model->body = $request->get('body');

        return $this->postRepository->update($model);
    }

    public function find(int $id)
    {
        $model = $this->postRepository->find($id);

        if (empty($model)) {
            throw new ResourceNotFoundException();
        }

        return $model;
    }

    public function destroy(int $id, Request $request)
    {$id = 20;
        $model = $this->postRepository->find($id);

        if (empty($model)) {
            throw new ResourceNotFoundException();
        }

        $this->postValidator->manipulation($model, $request);

        return $this->postRepository->destroy($model);
    }
}
