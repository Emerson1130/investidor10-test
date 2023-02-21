<?php

namespace App\Validators;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Exceptions\NoPermissionToHandleException;

class PostValidator
{
    public function manipulation(Post $post, Request $request)
    {
        if (!$post->belongsToUser(GlobalHelper::getLoggedUserId($request))) {
            throw new NoPermissionToHandleException();
        }

        return true;
    }
}
