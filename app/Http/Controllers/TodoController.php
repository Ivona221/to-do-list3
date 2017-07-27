<?php

namespace App\Http\Controllers;
use App\Http\Requests\TodoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Todo;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Repositories\TodoRepository;
use Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\DB;





class TodoController extends Controller
{


    /**
     * TodoController constructor.
     */
    protected $todos;

    public function __construct(TodoRepository $todos)
    {
        $this->todos = $todos;
    }

    public function index(Todo $todos){
        $i=0;

        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();
        $date = [
            'zero' => Carbon::now()->format('Y-m-d') ,
            'one'=>Carbon::now()->addDays(1)->format('Y-m-d'),
            'two'=>Carbon::now()->addDays(2)->format('Y-m-d'),
            'three'=>Carbon::now()->addDays(3)->format('Y-m-d'),
            'four'=>Carbon::now()->addDays(4)->format('Y-m-d'),
            'five'=>Carbon::now()->addDays(5)->format('Y-m-d'),
            'six'=>Carbon::now()->addDays(6)->format('Y-m-d'),
            'seven'=>Carbon::now()->addDays(7)->format('Y-m-d')

        ];

       foreach($date as $d){
           $todos[$d]=$this->todos->byDate($d);
       }

       $now=$this->todos->date();



        return view('todo.index',compact('complete','incomplete', 'date', 'todos','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork','now'));

    }

    public function store(TodoRequest $request){

        $this->create($request);
        return back();

    }

    public function create(TodoRequest $request)
    {

        //$todo=Auth::user()->todos()->create($request->all());
        return $this->todos->create($request->all());
    }

    public function show(Todo $todos,$date){

        $todos=$this->todos->byDate($date);
        $number=$this->todos->count($date);

        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        return view('todo.specific', compact('todos','date','number', 'complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));
    }

    public function show2(){
        return view('todo.index');
    }

    public function image(){
        return view('todo.images');
    }

    public function stats(){
        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        $order=$this->todos->order();
        return view('todo.stats' , compact('order', 'complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));
    }

    public function save($id){
        $imageTempName = request()->file('avatar')->getPathname();
        $imageName = request()->file('avatar')->getClientOriginalName();
        $path = base_path() . '/public/uploads/consultants/images/';
        request()->file('avatar')->move($path , $imageName);
        $this->todos->update($id, $imageName);
    }

    public function update(){
        $id=request()->get('id');
        $value=request()->get('agree',0);
        $todo=$this->todos->find($id);
        if($todo->checked==true)
            $todo->checked=false;
        else
        $todo->checked=$value;
        $todo->save();
        return back();
    }

    public function search(){
        $date=request()->get('date');
        $todos=$this->todos->byDate($date);

        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        return view('todo.search', compact('date','todos','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));
    }

    public function search1(){
        $type=request()->get('type');
        if($type=='all')
            $todos=$this->todos->user();
        else
        $todos=$this->todos->byType($type);

        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        return view('todo.search1', compact('type','todos','image','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));

    }

    public function show3($type){
        if($type =="all")
            $todos=$this->todos->user();
        else
        $todos=$this->todos->byType($type);

        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        return view('todo.search1', compact('todos', 'type', 'complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));

}

    public function byDate($date){

        $todos=$this->todos->byDate($date);

        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        return view('todo.search', compact('todos', 'date','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));
    }

    public function update2($id){

        $todo=$this->todos->find($id);

        if($todo->checked==false||$todo->checked==NULL)

        $todo->checked=true;

        else
            $todo->checked=false;
        $todo->save();
        return back();
    }







}
