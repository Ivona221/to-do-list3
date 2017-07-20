<?php

namespace App\Http\Controllers;
use App\Http\Requests\TodoRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Todo;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Mail;


class TodoController extends Controller
{




    public function index(Todo $todos){
        // $todos=Todo::where('date',$date)->get();


        return view('todo.index');

    }

    public function check($id){
        $todo=Todo::where('id',$id)->first();
        $todo->update(['checked'=> true]);
        $todo->save();
        return back();




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

        $todos=Todo::where(['date'=>$date,'user_id'=>Auth::user()->id])->get();
        $number=Todo::where(['date'=>$date])->count();
        return view('todo.specific', compact('todos','date','number'));


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
        $todo=\App\Todo::where('id',$id)->first();
        $todo->checked=$value;
        $todo->save();
        return back();
    }

    public function search(){
        $date=request()->get('date');
        $todos=\App\Todo::where(['date'=> $date,'user_id'=>Auth::user()->id])->get();
        return view('todo.search', compact('date','todos'));
    }

    public function sendEmail(Request $request){




        $user = \App\User::findOrFail(2);

        Mail::send('emails.reminder', [$user->name], function($message) use ($request)
        {
            $message->from('ivonamilanova221@gmail.com', 'Ivona');

            $message->subject('Some subject');

            $message->to('ivonamilanova@yahoo.com', 'Ivona');

        });

       return "Success";




    }


}
