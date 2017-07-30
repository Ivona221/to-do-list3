<?php
/**
 * Created by PhpStorm.
 * User: imi
 * Date: 7/28/17
 * Time: 7:12 AM
 */

namespace Tests\Unit;


use App\Http\Controllers\TodoController;
use App\Http\Requests\TodoRequest;
use App\Repositories\TodoRepository;
use App\Todo;
use Illuminate\Support\Facades\Redirect;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;




/**
 * @property \Mockery\MockInterface todoRepo
 */
class TodoControllerTest extends TestCase
{
    public function setUp()
    {
        $this->todoRepo = Mockery::mock(TodoRepository::class);
        $this->class = new TodoController($this->todoRepo);
    }

    /** @test */
    /*public function createTest()
    {
        $req = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work', 'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'user_id' => 1
        ];

        $req=['task'=>'test'];


        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('all')->andReturn($req);
        $this->todoRepo->shouldReceive('create')->with($req)->andReturn(true);
        //Redirect::shouldReceive('route')->with('home');
        //$this->class->create($request$);
        //$this->get('/todoAdd')->assertStatus(200);


    }*/


    /** @test */
    /*public function index(){
    $complete = 3;
    $this->todoRepo->shouldReceive('complete')->andReturn($complete);
    $date=\Carbon\Carbon::now()->format('Y-m-d');
    $todo=Mockery::mock(Todo::class);


    $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);
    $this->todoRepo->shouldReceive('byDate')->andReturn($todo);
    $this->todoRepo->shouldReceive('date')->andReturn($date);

    View::shouldReceive('make')->with('todo.index', Mockery::any())->once();



    }*/
    /** @test */
    /*public function imageTest(){
        $this->call('GET', 'todo.images');

    }*/

    /** @test */
    /*public function saveTest(){

        Storage::fake('avatars');

        $response = $this->json('POST', '/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $path          = storage_path('app/public/matrix.png');
        $original_name = 'matrix.png';
        $mime_type     = 'image/png';
        $size          = 2476;
        $error         = null;
        $test          = true;

        $file = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

        $this->call('POST', 'avatars/{id}', [], [], ['upload' => $file], []);

        $this->assertResponseOk();


    }*/

    /** @test */
   /* public function imageTest(){
        $this->visit('/images');

    }*/

   /** @test */

   public function saveTest(){
       Storage::fake('avatars');

       $response = $this->json('POST', '/avatars', [
           'avatar' => UploadedFile::fake()->image('avatar.jpg')
       ]);

       Storage::disk('avatars')->assertExists('avatar.jpg');

       Storage::disk('avatars')->assertMissing('missing.jpg');

       /*$this->call('POST',
           '/upload',
           [
               'id' => 1
           ],
           [],
           $_FILES,
           []
       );

       $this->seeJson([
           'id' => 1,
           //other vars
       ]);*/
   }








}