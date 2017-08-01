<?php
namespace Tests\Unit;


use App\Event;
use App\Http\Controllers\TodoController;
use App\Http\Requests\TodoRequest;
use App\Repositories\TodoRepository;
use App\Todo;
use Illuminate\Support\Facades\Redirect;
use MaddHatter\LaravelFullcalendar\Calendar;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EventController;
use App\Repositories\EventRepository;




/**
* @property \Mockery\MockInterface eventRepo
*/
class EventControllerTest extends TestCase
{
public function setUp()
{
    $this->eventRepo = Mockery::mock(EventRepository::class);
    $this->class = new EventController($this->eventRepo);
    $this->event = Mockery::mock(Event::class);
}

/** @test */

/*public function index(){
    $events=[];
    $complete=3;
    $event=[
        'user_id'=>1,
        'title'=>'NewEvent',
        'start_date'=>\Carbon\Carbon::now()->format('Y-m-d'),
        'end_date'=>\Carbon\Carbon::now()->format('Y-m-d')
    ];

    $name='Title';
    $date=\Carbon\Carbon::now()->format('Y-m-d');
    $this->eventRepo->shouldReceive('find')->andReturn($events);

    $this->eventRepo->shouldReceive('count')->andReturn(1);
    Calendar::shouldReceive('event')->with($name, true, $date,$date)->andReturn(true);
    Calendar::shouldReceive('addEvents')->with($event)->andReturn(true);

    $this->eventRepo->shouldReceive('complete')->andReturn($complete);
    $this->eventRepo->shouldReceive('incomplete')->andReturn($complete);
    $this->eventRepo->shouldReceive('notcomplete')->andReturn($complete);
    $this->eventRepo->shouldReceive('notcompleteWork')->andReturn($complete);
    $this->eventRepo->shouldReceive('notcompleteHome')->andReturn($complete);
    $this->eventRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
    $this->eventRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

    View::shouldReceive('make')->with('mycalendar', Mockery::any());
    $this->class->index();

}*/





}