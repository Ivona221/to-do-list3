<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MaddHatter\LaravelFullcalendar\Calendar;

use App\Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function index(){
        $events = [];

        $data = Event::where('user_id', Auth::user()->id)->get();

        if($data->count()){

            foreach ($data as $key => $value) {

                $events[] = Calendar::event(

                    $value->title,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date.' +1 day')



                );

            }

        }

        $calendar = \Calendar::addEvents($events);

        return view('mycalendar', compact('calendar'));
    }

    public function show(){
        return view('todo.events');
    }

    public function store(EventRequest $request){

        $this->create($request);
        return back();

    }

    public function create(EventRequest $request){

        $event=Auth::user()->events()->create($request->all());
        return $event;

    }
}
