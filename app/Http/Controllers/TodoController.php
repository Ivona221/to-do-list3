<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redis;


class TodoController extends Controller
{
    /**
     * TodoController constructor.
     */

    protected $todos;

    public function __construct(TodoRepositoryInterface $todos)
    {
        $this->todos = $todos;
    }

    //tested
    public function index()
    {

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        $date = [
            'zero' => Carbon::now()->format('Y-m-d'),
            'one' => Carbon::now()->addDays(1)->format('Y-m-d'),
            'two' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'three' => Carbon::now()->addDays(3)->format('Y-m-d'),
            'four' => Carbon::now()->addDays(4)->format('Y-m-d'),
            'five' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'six' => Carbon::now()->addDays(6)->format('Y-m-d'),
            'seven' => Carbon::now()->addDays(7)->format('Y-m-d')

        ];

        foreach ($date as $d) {
            $todos[$d] = $this->todos->byDate($d);
        }

        $now = $this->todos->date();

        $nowTime = $this->todos->time();

        $usrId = $this->todos->id();

        return View::make('todo.index', compact('complete', 'incomplete', 'date', 'todos', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork', 'now', 'nowTime', 'usrId'));

    }


    //tested
    public function create(TodoRequest $request)
    {

        $this->todos->create($request->all());

        return Redirect::route('home');


    }

    //tested
    public function show($date)
    {

        $todos = $this->todos->byDate($date);

        $number = $this->todos->count($date);

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        return View::make('todo.specific', compact('todos', 'date', 'number', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));
    }


    //tested
    public function stats()
    {

        $storage=Redis::Connection();
        $popular=$storage->zRevRange('todoViews',0,2);

        foreach($popular as $value){
            $date1[$value]=str_replace('todo:','',$value);

        }

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        $order = $this->todos->order();

        return View::make('todo.stats', compact('order', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork','date1'));
    }


    //testing
    public function save(Request $request, $id)
    {

        $file = request()->file('avatar');

        $imageName = $this->todos->getName($file);

        $path = '/home/imi/Downloads/to-do-list3-master/public/images';


        $this->todos->moveFile($file, $path, $imageName);

        $this->todos->updateImage($id, $imageName);

        return Redirect::back();
    }

    //testingF
    public function update(Request $request)
    {

        $id = request()->get('id');

        $todo = $this->todos->find($id);

        if ($todo->checked == true)
            $bool = false;
        else
            $bool = true;

        $this->todos->updateChecked($id, $bool);

        return Redirect::back();
    }

    //testing
    public function update2($id)
    {

        $todo = $this->todos->find($id);

        if ($todo->checked == false || $todo->checked == NULL)
            $bool1 = true;
        else
            $bool1 = false;

        $this->todos->updateChecked($id, $bool1);

        return Redirect::route('home');

    }


    //tested
    public function search(TodoRequest $request)
    {

        $date = $request->get('date');

        $todos = $this->todos->byDate($date);

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        return View::make('todo.search', compact('date', 'todos', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));
    }


    //tested
    public function search1(TodoRequest $request)
    {

        $type = $request->get('type');

        if ($type == 'all')
            $todos = $this->todos->user();
        else
            $todos = $this->todos->byType($type);

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        return View::make('todo.search1', compact('type', 'todos', 'image', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));

    }

    //tested
    public function show3($type)
    {

        if ($type == "all")
            $todos = $this->todos->user();
        else
            $todos = $this->todos->byType($type);

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        return View::make('todo.search1', compact('todos', 'type', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));

    }

    //tested
    public function byDate($date)
    {



        $storage=Redis::Connection();

        if($storage->zScore('todoViews', 'todo'.$date)){

            $storage->pipeline(function($pipe) use ($date){
                $pipe->zIncrBy('todoViews',1,'todo:'. $date);
                $pipe->incr("todo:".$date.":views");
            });

        }
        else{
            $views=$storage->incr("todo:".$date.":views");
            $storage->zIncrBy('todoViews',$views,'todo:'.$date);
        }

        $views=$storage->get("todo:".$date.":views");



        $todos = $this->todos->byDate($date);
        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        return View::make('todo.search', compact('todos', 'date', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork','views'));
    }


    //tested
    public function edit(TodoRequest $request)
    {


        $id = $request->get('todoId');

        $todo = $this->todos->findId($id);

        $todo->update($request->all());

        return Redirect::route('edit', $id);


    }

    //tested
    public function editTodo($id)
    {

        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        $todo = $this->todos->findId($id);

        $now = $this->todos->date();

        $nowTime = $this->todos->time();

        $usrId = $this->todos->id();

        $date = $this->todos->date();

        return View::make('todo.edit', compact('todo', 'now', 'nowTime', 'date', 'usrId', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));
    }

    public function namechange(Request $request)
    {

        $name = Request::get('changedName');

        $user = $this->todos->authUser();

        $user->name = $name;

        $user->save();

        return Redirect::back();

    }


}
