<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Services\BookService;
use App\Traits\ControllerActions;
use App\Exceptions\ResourceNotFoundException;
use App\Contracts\DomainModel;

class BookController extends Controller
{

    use ControllerActions;

    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        try {
            $id = $this->bookService->store($request);
            $status = (!empty($id));
            $message = ($status) ? 'Book saved.' : 'Error on store the book.';
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
            $resource = $this->bookService->find($id);
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
    public function update(BookRequest $request, $id)
    {
        $status = false;

        try {
            $status = $this->bookService->update($id, $request);
            $message = ($status) ? 'Book updated.' : 'Error on update the book.';
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
            $status = $this->bookService->destroy($id, $request);
            $message = ($status) ? 'Book destroyed.' : 'Error on destroy the book.';
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
