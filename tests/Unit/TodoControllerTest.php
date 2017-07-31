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

Use Carbon\Carbon;

use Illuminate\Support\Facades\DB;




/**
 * @property \Mockery\MockInterface todoRepo
 */
class TodoControllerTest extends TestCase
{
    public function setUp()
    {
        $this->todoRepo = Mockery::mock(TodoRepository::class);
        $this->class = new TodoController($this->todoRepo);
        $this->todo=Mockery::mock(Todo::class);
        $this->fileSystem = Mockery::mock('Illuminate\Filesystem\Filesystem');
        $this->storage = Mockery::mock('Illuminate\Contracts\Filesystem\Factory');
    }

    /** @test */
    public function createTest()
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
        Redirect::shouldReceive('route')->with('home')->andReturnSelf();
        $this->class->create($request);
        //$this->get('/todoAdd')->assertStatus(200);


    }


    /** @test */
    public function index(){
    $complete = 3;
    $this->todoRepo->shouldReceive('complete')->andReturn($complete);
    $date1=Carbon::now()->format('Y-m-d');

        $td = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work', 'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'user_id' => 1
        ];
        $this->todoRepo->shouldReceive('byDate')->andReturn($td);
        $time=\Carbon\Carbon::now()->format('H:i');
        $this->todoRepo->shouldReceive('id')->andReturn(1);
    $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);
    $this->todoRepo->shouldReceive('date')->andReturn($date1);
    $this->todoRepo->shouldReceive('time')->andReturn($time);

    View::shouldReceive('make')->with('todo.index', Mockery::any());
    $this->class->index();





    }

    /** @test */
    public function show(){

        $complete = 3;

        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $number=Todo::where('date',$date)->count();
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $this->todoRepo->shouldReceive('byDate')->with($date)->andReturn(Todo::where('date',$date));
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        $this->todoRepo->shouldReceive('count')->with($date)->andReturn($number);



        View::shouldReceive('make')->with('todo.specific', Mockery::any());

        $this->class->show($date);


    }

    /** @test */
    public function stats(){

        $complete=3;
        $todos=[
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work', 'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'user_id' => 1

        ];

        /*$ordered=$todos->select('date', DB::raw('count(*) as total'))->groupBy('date')
            ->orderBy('total', 'desc')
            ->get();*/
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        $this->todoRepo->shouldReceive('order')->andReturn($todos);

        View::shouldReceive('make')->with('todo.stats', Mockery::any());

        $this->class->stats();


    }

    /** @test */
    public function search(){
        $complete=3;
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('key')->with('date')->andReturn($date);
        $this->todoRepo->shouldReceive('byDate')->with(NULL)->andReturn(Todo::where('date',$date));
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        View::shouldReceive('make')->with('todo.search', Mockery::any());

        $this->class->search();




    }

    /** @test */
    public function search1(){
        $complete=3;
        $type="home";
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('type')->andReturn($type);
        $this->todoRepo->shouldReceive('byType')->with(NULL)->andReturn(Todo::where('type',$type));
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

         View::shouldReceive('make')->with('todo.search1', Mockery::any());

        $this->class->search1();
    }

    /** @test */
    public function show3(){
        $complete=3;
        $type='home';
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('type')->andReturn($type);
        $this->todoRepo->shouldReceive('byType')->andReturn(Todo::where('type',$type));
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        View::shouldReceive('make')->with('todo.search1', Mockery::any());

        $this->class->show3($type);

}

/** @test */
public function byDate(){

    $complete=3;
    $date=\Carbon\Carbon::now()->format('Y-m-d');
    $this->todoRepo->shouldReceive('byDate')->andReturn(Todo::where('date',$date));
    $this->todoRepo->shouldReceive('complete')->andReturn($complete);
    $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
    $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

    View::shouldReceive('make')->with('todo.search', Mockery::any());

    $this->class->byDate($date);

}

    /** @test */
    /*public function save(){

        $test_file_path = base_path().'/public/images/photo.jpg';
        $this->assertTrue(file_exists($test_file_path), 'Test file does not exist');

    }*/

    /** @test */

    /*public function update(){
        $id=1;
        $request = Mockery::mock(TodoRequest::class);
        $id1=$request->shouldReceive('get')->with('id')->andReturn($id);
        $request->shouldReceive('get')->with('agree')->andReturn(true);
        $this->todoRepo->shouldReceive('find')->with(NULL)->andReturn(Todo::where('id',$id1));
        $todo=Mockery::mock(Todo::class);

        $todo->shouldReceive('save');


        Redirect::shouldReceive('route')->with('date')->andReturnSelf();
        $this->class->update();



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
       /*Storage::fake('avatars');

       $response = $this->json('POST', '/avatars', [
           'avatar' => UploadedFile::fake()->image('avatar.jpg')
       ]);

       Storage::disk('avatars')->assertExists('avatar.jpg');

       Storage::disk('avatars')->assertMissing('missing.jpg');*/

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

   /** @test */
   public function editTodo(){
       $complete=3;
       $id=1;
       $date=\Carbon\Carbon::now()->format('Y-m-d');
       $time=\Carbon\Carbon::now()->format('H:i');
       $this->todoRepo->shouldReceive('findId')->with($id)->andReturn(Todo::where('id'.$id));
       $this->todoRepo->shouldReceive('id')->andReturn(1);
       $this->todoRepo->shouldReceive('date')->andReturn($date);
       $this->todoRepo->shouldReceive('time')->andReturn($time);
       $this->todoRepo->shouldReceive('complete')->andReturn($complete);
       $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
       $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
       $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
       $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
       $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
       $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

       View::shouldReceive('make')->with('todo.edit', Mockery::any());

    $this->class->editTodo($id);
   }


   /** @test */
   public function edit(){
       $id=1;
       $td = [
           'task' => 'test',
           'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
           'start_time' => \Carbon\Carbon::now()->format('H:i'),
           'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
           'end_time' => \Carbon\Carbon::now()->format('H:i'),
           'type' => 'work', 'date' => \Carbon\Carbon::now()->format('Y-m-d'),
           'user_id' => 1
       ];
       $request = Mockery::mock(TodoRequest::class);
       $request->shouldReceive('get')->with('todoId')->andReturn($id);
       $this->todoRepo->shouldReceive('findId')->with($id)->andReturn(Todo::where('id',$id));
       $this->todoRepo->shouldReceive('update')->with($td)->andReturn(true);
       $request->shouldReceive('all')->andReturn($td);

       Redirect::shouldReceive('route')->with('edit')->andReturnSelf();
       $this->class->edit($request);



   }







}