<?php

namespace App\Http\Controllers;

use App\Ocasion;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;

use MaddHatter\LaravelFullcalendar\Calendar;

use App\Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventRequest;

use Illuminate\Support\Facades\View;
use App\User;


class EventController extends Controller
{


    /**
     * EventController constructor.
     */

    protected $events;

    public function __construct(EventRepository $events)
    {

        $this->events = $events;

    }

    public function index()
    {
        $events = [];

        $data = $this->events->find();

        if ($data->count()) {

            foreach ($data as $key => $value) {

                $events[] = Calendar::event(

                    $value->title,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date . ' +1 day')


                );

            }

        }

        $calendar = \Calendar::addEvents($events);

        $complete = $this->events->complete();
        $incomplete = $this->events->incomplete();
        $notcomplete = $this->events->notcomplete();
        $notcompleteWork = $this->events->notcompleteWork();
        $notcompleteHome = $this->events->notcompleteHome();
        $notcompleteSchool = $this->events->notcompleteSchool();
        $notcompleteFreeTime = $this->events->notcompleteFreeTime();


        return View::make('mycalendar', compact('calendar', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));
    }

    public function show()
    {

        $now = $this->events->now();
        return view('todo.events', compact('now'));
    }

    public function store(EventRequest $request)
    {

        $this->create($request);
        $events = [];

        $data = $this->events->find();

        if ($data->count()) {

            foreach ($data as $key => $value) {

                $events[] = Calendar::event(

                    $value->title,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date . ' +1 day')


                );

            }

        }

        $calendar = \Calendar::addEvents($events);

        $complete = $this->events->complete();
        $incomplete = $this->events->incomplete();
        $notcomplete = $this->events->notcomplete();
        $notcompleteWork = $this->events->notcompleteWork();
        $notcompleteHome = $this->events->notcompleteHome();
        $notcompleteSchool = $this->events->notcompleteSchool();
        $notcompleteFreeTime = $this->events->notcompleteFreeTime();

        return view('mycalendar', compact('calendar', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));

    }

    public function create(EventRequest $request)
    {

        $event = Auth::user()->events()->create($request->all());

        return $event;

    }


}
