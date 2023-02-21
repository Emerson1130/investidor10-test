<?php

namespace App\Services;

use App\Services\PostService;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;

class DashboardService
{
    private PostService $postService;

    public function __construct(
            PostService $postService,
    )
    {
        $this->postService = $postService;
    }

    public function getIndexData(Request $request)
    {
        return [
            'posts' => $this->postService->get(),
            'logged_user_id' => GlobalHelper::getLoggedUserId($request)
        ];
    }
}
