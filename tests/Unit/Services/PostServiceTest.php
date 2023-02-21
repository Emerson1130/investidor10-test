<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\PostRepository;
use App\Factories\PostFactory;
use App\Validators\PostValidator;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostServiceTest extends TestCase
{
    private PostService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PostRepository::class);
        $this->factory = $this->createMock(PostFactory::class);
        $this->validator = $this->createMock(PostValidator::class);
        $this->user = $this->createMock(User::class);
        $this->post = $this->createMock(Post::class);

        $this->request = $this->createMock(Request::class);
        $this->service = new PostService(
                $this->repository, $this->factory, $this->validator
        );
    }

    public function test_store_should_fail()
    {
        $this->request->expects($this->any())
                ->method('get')
                ->withConsecutive(['title'], ['body'], ['category'])
                ->will($this->onConsecutiveCalls('test', '12.50', 'action'));

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
                            'title' => 'test',
                            'body' => '12.50',
                            'category' => 'action',
                            'user_id' => 1
                        ]
                )
                ->willReturn($this->post);

        $this->repository
                ->expects($this->once())
                ->method('store')
                ->with($this->post)
                ->willReturn(false);

        $result = $this->service->store($this->request);

        $this->assertFalse($result);
    }
}
