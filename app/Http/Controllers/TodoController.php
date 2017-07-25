<?php

namespace App\Http\Controllers;
use App\Http\Requests\TodoRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Todo;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Mail;

use App\Repositories\TodoRepository;
use Repositories\TodoRepositoryInterface;




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

        return view('todo.index');

    }

    public function store(TodoRequest $request){

        $this->create($request);
        return back();

    }

    public function create(TodoRequest $request){

        $todo=Auth::user()->todos()->create($request->all());
        return $todo;

    }

    public function show(Todo $todos,$date){

        $todos=$this->todos->byDate($date);
        $number=$this->todos->count($date);
        return view('todo.specific', compact('todos','date','number'));
    }

    public function show2(){
        return view('todo.index');
    }

    public function image(){
        return view('todo.images');
    }

    public function stats(){
        return view('todo.stats');
    }

    public function save($id){
        $imageTempName = request()->file('avatar')->getPathname();
        $imageName = request()->file('avatar')->getClientOriginalName();
        $path = base_path() . '/public/uploads/consultants/images/';
        request()->file('avatar')->move($path , $imageName);
        DB::table('todos')
            ->where('id', $id)
            ->update(['image' => $imageName]);
    }

    public function update(){
        $id=Input::get('id');
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
        return view('todo.search', compact('date','todos'));
    }

    public function search1(){
        $type=request()->get('type');
        if($type=='all')
            $todos=$this->todos->user();
        else
        $todos=$this->todos->byType($type);
        return view('todo.search1', compact('type','todos'));

    }

    /*public function sendEmail(Request $request){

        $user = \App\User::findOrFail(2);

        Mail::send('emails.reminder', [$user->name], function($message) use ($request)
        {
            $message->from('ivonamilanova221@gmail.com', 'Ivona');

            $message->subject('Some subject');

            $message->to('ivonamilanova@yahoo.com', 'Ivona');

        });

       return "Success";

    }*/

    public function show3($type){

        $todos=$this->todos->byType($type);
        return view('todo.search1', compact('todos'));

}

    public function byDate($date){

        $todos=$this->todos->byDate($date);
        return view('todo.search', compact('todos', 'date'));
    }


}
