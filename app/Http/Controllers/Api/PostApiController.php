<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Traits\ApiControllerActions;
use App\Exceptions\ResourceNotFoundException;
use App\Contracts\DomainModel;
use App\Http\Controllers\Controller;

class PostApiController extends Controller
{

    use ApiControllerActions;

    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $id = $this->postService->store($request);
            $status = (!empty($id));
            $message = ($status) ? 'Post saved.' : 'Error on store the post.';
            $httpCode = ($status) ? 201 : 500;
        } catch (Throwable $throwable) {
            $id = null;
            $status = false;
            $message = $throwable->getMessage();
            $httpCode = 500;
        }

        $response = compact('id', 'message');
        return $this->response($status, $response, $httpCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = null;
        $status = false;

        try {
            $resource = $this->postService->find($id);
            $status = ($resource instanceof DomainModel);
            $httpCode = ($status) ? 200 : 500;
            $message = 'Resource found.';
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
            $httpCode = 404;
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
            $httpCode = 500;
        }

        $response = compact('resource', 'message');
        return $this->response($status, $response, $httpCode);
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
            $httpCode = ($status) ? 200 : 500;
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
            $httpCode = 404;
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
            $httpCode = 500;
        }

        return $this->response($status, ['message' => $message], $httpCode);
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
            $httpCode = ($status) ? 200 : 500;
        } catch (ResourceNotFoundException $exception) {
            $message = $exception->getMessage();
            $httpCode = 404;
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
            $httpCode = 500;
        }

        return $this->response($status, ['message' => $message], $httpCode);
    }

}
