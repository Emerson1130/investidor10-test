<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use App\Factories\BookFactory;
use App\Exceptions\ResourceNotFoundException;
use App\Helpers\GlobalHelper;
use App\Validators\BookValidator;

class BookService
{

    private BookRepository $bookRepository;
    private BookFactory $bookFactory;
    private BookValidator $bookValidator;

    public function __construct(
        BookRepository $bookRepository,
        BookFactory $bookFactory,
        BookValidator $bookValidator,
    )
    {
        $this->bookRepository = $bookRepository;
        $this->bookFactory = $bookFactory;
        $this->bookValidator = $bookValidator;
    }

    public function store(Request $request)
    {
        $model = $this->bookFactory->create([
            'name' => $request->get('name'),
            'isbn' => $request->get('isbn'),
            'value' => $request->get('value'),
            'user_id' => GlobalHelper::getLoggedUserId($request)
        ]);

        $status = $this->bookRepository->store($model);
        return ($status) ? $model->id : false;
    }

    public function update(int $id, Request $request)
    {
        $model = $this->bookRepository->find($id);

        if (empty($model)) {
            throw new ResourceNotFoundException();
        }

        $this->bookValidator->manipulation($model, $request);

        $model->name = $request->get('name');
        $model->isbn = $request->get('isbn');
        $model->value = $request->get('value');

        return $this->bookRepository->update($model);
    }
    
    public function find(int $id)
    {
        $model = $this->bookRepository->find($id);

        if (empty($model)) {
            throw new ResourceNotFoundException();
        }

        return $model;
    }

    public function destroy(int $id, Request $request)
    {
        $model = $this->bookRepository->find($id);

        if (empty($model)) {
            throw new ResourceNotFoundException();
        }

        $this->bookValidator->manipulation($model, $request);

        return $this->bookRepository->destroy($model);
    }

}
