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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\User;


/**
 * @property \Mockery\MockInterface todoRepo
 */
class TodoControllerTest extends TestCase
{
    public function setUp()
    {
        $this->todoRepo = Mockery::mock(TodoRepository::class);
        $this->class = new TodoController($this->todoRepo);
        $this->todo = Mockery::mock(Todo::class);
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

        //$req=['task'=>'test'];


        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('all')->andReturn($req);
        $this->todoRepo->shouldReceive('create')->with($req)->andReturn(true);
        Redirect::shouldReceive('route')->with('home')->andReturnSelf();
        $this->class->create($request);
        //$this->get('/todoAdd')->assertStatus(200);


    }


    /** @test */
    public function index()
    {
        $complete = 3;
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $date1 = Carbon::now()->format('Y-m-d');

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
        $time = \Carbon\Carbon::now()->format('H:i');
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
    public function show()
    {

        $complete = 3;

        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $number = Todo::where('date', $date)->count();
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $todos = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work',
            'date' => $date,
            'user_id' => 1,


        ];
        $this->todoRepo->shouldReceive('byDate')->with($date)->andReturn($todos);
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
    public function stats()
    {

        $complete = 3;
        $todos = [
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
    public function search()
    {
        $complete = 3;
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $request = Mockery::mock(TodoRequest::class);
        $todos = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work',
            'date' => $date,
            'user_id' => 1,


        ];
        $request->shouldReceive('get')->with('date')->andReturn($date);
        $this->todoRepo->shouldReceive('byDate')->with($date)->andReturn($todos);
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        View::shouldReceive('make')->with('todo.search', Mockery::any());

        $this->class->search($request);


    }

    /** @test */
    public function search1()
    {
        $complete = 3;
        $type = "home";
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $todos = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work',
            'date' => $date,
            'user_id' => 1,


        ];
        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('get')->with('type')->andReturn($type);
        $this->todoRepo->shouldReceive('byType')->with($type)->andReturn($todos);
        $this->todoRepo->shouldReceive('complete')->andReturn($complete);
        $this->todoRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->todoRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        View::shouldReceive('make')->with('todo.search1', Mockery::any());

        $this->class->search1($request);
    }

    /** @test */
    public function show3()
    {
        $complete = 3;
        $type = 'home';
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $todos = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work',
            'date' => $date,
            'user_id' => 1,


        ];
        $request = Mockery::mock(TodoRequest::class);
        $request->shouldReceive('get')->with('type')->andReturn($type);
        $this->todoRepo->shouldReceive('byType')->andReturn($todos);
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
    public function byDate()
    {

        $complete = 3;
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $todos = [
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work',
            'date' => $date,
            'user_id' => 1,


        ];
        $this->todoRepo->shouldReceive('byDate')->andReturn($todos);
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
    public function save()
    {

        /*$imageName='alien.png';
        $id=4;


        $original_name = 'alien.png';
        $mime_type = 'image/png';
        $size = 2192;
        $error = null;
        $test = true;

        $todos=[
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work',
            'date'=>\Carbon\Carbon::now()->format('Y-m-d'),
            'user_id' => 1,
            'avatar' => new UploadedFile($path,Mockery::any()),

        ];

        $file = new UploadedFile($path,Mockery::any());
        $request = Mockery::mock(TodoRequest::class);
        $fileMock= Mockery::mock(UploadedFile::class);
        $request->shouldReceive('get')->once()->with('avatar')->andReturn($fileMock);*/
        $path = '/home/imi/Downloads/to-do-list3-master/public/images/alien.png';

        $imageName = 'alien.png';
        $id = 4;
        $original_name = 'alien.png';
        $mime_type = 'image/png';
        $size = 2192;
        $error = null;
        $test = true;
        $file = new UploadedFile($path, Mockery::any());
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('file')->with('avatar')->andReturn($file);
        //Request::shouldReceive('file')->with('avatar')->andReturn($file);
        $this->todoRepo->shouldReceive('getName')->with((object)$file)->andReturn($imageName);
        $this->todoRepo->shouldReceive('moveFile')->with((object)$file, "/home/imi/Downloads/to-do-list3-master/public/images", "alien.png")->andReturn(true);
        $this->todoRepo->shouldReceive('updateImage')->with($id, $imageName)->andReturn(true);
        Redirect::shouldReceive('back')->andReturnSelf();


        $this->class->save($request, $id);


    }

    /** @test */
    public function update()
    {
        $id = 8;
        $bool = false;
        $td = (object)[
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work', 'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'user_id' => 1,
            'checked' => false,
        ];
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('get')->with('id')->andReturn($id);

        $this->todoRepo->shouldReceive('find')->with($id)->andReturn($td);
        //$this->todoRepo->shouldReceive('getAttribute')->with('checked')->andReturn($bool);
        $this->todoRepo->shouldReceive('updateChecked')->once()->andReturn(false);


        Redirect::shouldReceive('route')->with('date')->andReturnSelf();
        $this->class->update($request);


    }

    /** @test */
    public function update2()
    {
        $id = 1;
        $td = (object)[
            'task' => 'test',
            'start_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::now()->format('H:i'),
            'end_date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'end_time' => \Carbon\Carbon::now()->format('H:i'),
            'type' => 'work', 'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'user_id' => 1,
            'checked' => 1,
        ];
        $bool = false;
        $this->todoRepo->shouldReceive('find')->with($id)->andReturn($td);
        $this->todoRepo->shouldReceive('getAttribute')->with('checked')->andReturn($bool);
        $this->todoRepo->shouldReceive('setAttribute')->with('checked')->andReturn(false);

        //$todo=Mockery::mock(Todo::class);

        $this->todoRepo->shouldReceive('updateChecked')->once()->andReturn(true);

        Redirect::shouldReceive('route')->with('home')->andReturnSelf();

        $this->class->update2($id);
    }

    /** @test */
    public function editTodo()
    {
        $complete = 3;
        $id = 1;
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $time = \Carbon\Carbon::now()->format('H:i');
        $this->todoRepo->shouldReceive('findId')->with($id)->andReturn(Todo::where('id' . $id));
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
    public function edit()
    {
        $id = 1;
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
        $this->todoRepo->shouldReceive('findId')->with($id)->andReturn(Todo::where('id', $id));
        $this->todoRepo->shouldReceive('update')->with($td)->andReturn(true);
        $request->shouldReceive('all')->andReturn($td);

        Redirect::shouldReceive('route')->with('edit', $id)->andReturnSelf();
        $this->class->edit($request);


    }

    /** @test */
    public function namechange(){
        $name='testName';
        $user=factory(User::class)->create();
        Request::shouldReceive('get')->with('changedName')->andReturn($name);
        $this->todoRepo->shouldReceive('authUser')->andReturn($user);
        $this->todoRepo->shouldReceive('setAttribute')->with('name')->andReturn(true);
        $this->todoRepo->shouldReceive('save')->andReturn(true);

        Redirect::shouldReceive('back')->andReturnSelf();

        $this->class->edit();



    }


}