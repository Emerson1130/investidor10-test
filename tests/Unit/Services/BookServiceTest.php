<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\BookRepository;
use App\Factories\BookFactory;
use App\Validators\BookValidator;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class BookServiceTest extends TestCase
{

    private BookService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(BookRepository::class);
        $this->factory = $this->createMock(BookFactory::class);
        $this->validator = $this->createMock(BookValidator::class);
        $this->user = $this->createMock(User::class);
        $this->book = $this->createMock(Book::class);

        $this->request = $this->createMock(Request::class);
        $this->service = new BookService(
                $this->repository, $this->factory, $this->validator
        );
    }

    public function test_store_should_fail()
    {
        $this->request->expects($this->any())
                ->method('get')
                ->withConsecutive(['name'], ['isbn'], ['value'])
                ->will($this->onConsecutiveCalls('test', 123, 12.50));

        $this->request
                ->expects($this->once())
                ->method('user')
                ->with()
                ->willReturn($this->user);

        $this->user
                ->expects($this->once())
                ->method('getAttribute')
                ->with('id')
                ->willReturn(1);

        $this->factory
                ->expects($this->once())
                ->method('create')
                ->with(
                        [
                            'name' => 'test',
                            'isbn' => 123,
                            'value' => 12.50,
                            'user_id' => 1
                        ]
                )
                ->willReturn($this->book);

        $this->repository
                ->expects($this->once())
                ->method('store')
                ->with($this->book)
                ->willReturn(false);

        $result = $this->service->store($this->request);

        $this->assertFalse($result);
    }

}
