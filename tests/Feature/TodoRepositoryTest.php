<?php

namespace Tests\Feature;

use App\Repositories\TodoRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use App\Todo;

class TodoRepositoryTest extends TestCase
{
    /**
     *@property Mockery\MockInterface todoModel
     * @property TodoRepository class
     *
     * @return void
     */

    protected $todoModel;

    public function setUp()
    {

        $this->todoModel = Mockery::mock(Todo::class);
        $this->class = new TodoRepositoryTest($this->todoModel);

    }


    /** @test */
    public function create()
    {
        $data = [];
//        $this->todoModel->shouldReceive('create')->once()->andReturn($this->todoModel);
//        $todo = $this->class->create($data);
//        $this->assertEquals($todo, $this->todoModel);
    }
}
