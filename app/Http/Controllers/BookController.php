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
            $httpCode = 201;
        } catch (Throwable $exc) {
            $id = null;
            $status = false;
            $message = $exc->getMessage();
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
            $httpCode = 200;
            $status = ($resource instanceof DomainModel);
            $message = 'Resource found.';
        } catch (ResourceNotFoundException $exc) {
            $message = $exc->getMessage();
            $httpCode = 404;
        } catch (Throwable $exc) {
            $message = $exc->getMessage();
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
        try {
            $status = $this->bookService->update($id, $request);
            $message = ($status) ? 'Book updated.' : 'Error on update the book.';
            $httpCode = 200;
        } catch (Throwable $exc) {
            $status = false;
            $message = $exc->getMessage();
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
        try {
            $status = $this->bookService->destroy($id, $request);
            $message = ($status) ? 'Book destroyed.' : 'Error on destroy the book.';
            $httpCode = 200;
        } catch (Throwable $exc) {
            $status = false;
            $message = $exc->getMessage();
            $httpCode = 500;
        }

        return $this->response($status, ['message' => $message], $httpCode);
    }

}
