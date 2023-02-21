<?php

namespace App\Services;

use App\Services\PostService;

class DashboardService
{
    private PostService $postService;

    public function __construct(
        PostService $postService,
    )
    {
        $this->postService = $postService;
    }

    public function getIndexData()
    {
        return [
            'posts' => $this->postService->get()
        ];
    }
}
