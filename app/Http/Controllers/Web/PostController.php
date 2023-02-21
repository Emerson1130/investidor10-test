<?php

namespace App\Http\Controllers\Web;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Traits\WebControllerActions;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    use WebControllerActions;

    const DEFAULT_RETURN_ROUTE = 'dashboard';

    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data = $this->postService->getSearchData($request);

        return view('crud.post.search-result', $data);
    }

    public function create()
    {
        return view('crud.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $status = false;

        try {
            $id = $this->postService->store($request);
            $status = (!empty($id));
            $message = ($status) ? "Post [$id] saved." : 'Error on store the post.';
        } catch (Throwable $throwable) {
            $status = false;
            $message = $throwable->getMessage();
        }

        return $this->response($status, $message, self::DEFAULT_RETURN_ROUTE);
    }
    
    public function preview(Request $request, $id)
    {
        $message = null;

        try {
            $data = $this->postService->getPreviewData($id, $request);
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
        }

        if (!is_null($message)) {
            return redirect('dashboard')->withErrors(['message' => $message]);
        }

        return view('crud.post.preview', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = null;

        try {
            $post = $this->postService->find($id);
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
        }

        if (!is_null($message)) {
            return redirect('dashboard')->withErrors(['message' => $message]);
        }

        return view('crud.post.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $status = false;

        try {
            $status = $this->postService->update($id, $request);
            $message = ($status) ? 'Post updated.' : 'Error on update the post.';
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
        }

        return $this->response($status, $message, self::DEFAULT_RETURN_ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $status = false;

        try {
            $status = $this->postService->destroy($id, $request);
            $message = ($status) ? 'Post destroyed.' : 'Error on destroy the post.';
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
        }

        return $this->response($status, $message, self::DEFAULT_RETURN_ROUTE);
    }

}
