<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use App\Contracts\CRUDContract;
use App\Factories\BookFactory;

class BookService
{

    private CRUDContract $bookRepository;
    private BookFactory $bookFactory;

    public function __construct(
        BookRepository $bookRepository,
        BookFactory $bookFactory
    )
    {
        $this->bookRepository = $bookRepository;
        $this->bookFactory = $bookFactory;
    }

    public function store(Request $request)
    {
        $model = $this->bookFactory->create([
            'name' => $request->get('name'),
            'isbn' => $request->get('isbn'),
            'value' => $request->get('value'),
            'user_id' => $request->user()->getAttribute('id')
        ]);

        $status = $this->bookRepository->store($model);
        return ($status) ? $model->id : false;
    }

}
