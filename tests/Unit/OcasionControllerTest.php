<?php

namespace Tests\Unit;

use App\Http\Requests\OcasionRequest;
use Repositories\OcasionRepositoryInterface;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\OcasionRepository;
use Mockery ;
use App\Ocasion;
use App\Http\Controllers\OcasionController;
use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class OcasionControllerTest extends TestCase
{
    /**
     * @property \Mockery\MockInterface occasionRepo
     *
     * @return void
     */
    public function setUp()
    {
        $this->occasionRepo = Mockery::mock(OcasionRepositoryInterface::class);
        $this->class = new OcasionController($this->occasionRepo);
        $this->todo=Mockery::mock(Ocasion::class);
        $this->user=Mockery::mock(User::class);

    }


    /** @test */
    public function eventCreate(){

        $id=4;
        $complete=3;
        $array=collect([1=>'User1',2=>'User2',3=>'User3'])->all();
        $users=factory(User::class,3)->create();
        $this->occasionRepo->shouldReceive('allUsers')->andReturn($users);
        $this->occasionRepo->shouldReceive('userId')->andReturn($id);
        $this->occasionRepo->shouldReceive('pluck')->andReturn($array);

        $this->occasionRepo->shouldReceive('complete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        View::shouldReceive('make')->with('events.createEvent', Mockery::any());

        $this->class->eventCreate();




    }

    /** @test */
   /* public function eventNew(){
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $time=\Carbon\Carbon::now()->format('H:i');
        $occasion=[
            'name'=>'test',
            'place'=>'testPlace',
            'date'=>$date,
            'time'=>$time,
            'organizer_id'=>4,

        ];
        $users=factory(User::class,3)->create();

        $user=factory(User::class)->create();

        $email=['ivonamilanova@yahoo.com', 'ross@friends.com'];

        $this->occasionRepo->shouldReceive('create')->with($occasion)->andReturn($user);

        $request = Mockery::mock(OcasionRequest::class);
        $request->shouldReceive('all')->andReturn($occasion);
        $request->shouldReceive('get')->with('users')->andReturn((object)$users);

        $this->occasionRepo->shouldReceive('users')->andReturn();

        $array=['occasion' => 'someName', 'place' => 'somePlace', 'time' => \Carbon\Carbon::now()->format('Y-m-d'), 'date' => \Carbon\Carbon::now()->format('H:i')];

        $subject = "The subject";
        $user = factory(User::class) -> create();

        Mail::shouldReceive('send') -> once() -> with(
            'emails.event',
            Mockery::on( function( $data ){
                $this -> assertArrayHasKey( 'user', $data );
                return true;
            }),
            Mockery::on( function(\Closure $closure) use ($user){
                $mock = Mockery::mock('Illuminate\Mailer\Message');
                $mock -> shouldReceive('to') -> once() -> with( $user -> email )
                    -> andReturn( $mock ); //simulate the chaining
                $mock -> shouldReceive('subject') -> once() -> with('The subject');
                $closure($mock);
                return true;
            })
        );
        Redirect::shouldReceive('route')->with('ocasion')->andReturnSelf();

        $this->class->eventNew($request);
    }*/

    /** @test */
    public function show(){
        $id=4;
        $complete=3;
        $this->occasionRepo->shouldReceive('complete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        View::shouldReceive('make')->with('events.ocasions', Mockery::any());
        View::shouldReceive('make')->with('events.ocasions', Mockery::any());

        $this->class->show();
    }

    /** @test */
    public function editOccasion(){
        $id=4;
        $complete=3;
        $array=collect([1=>'User1',2=>'User2',3=>'User3'])->all();
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $time=\Carbon\Carbon::now()->format('H:i');
        $occasion=[
            'name'=>'test',
            'place'=>'testPlace',
            'date'=>$date,
            'time'=>$time,
            'organizer_id'=>4,

        ];
        $place='somePlace';
        $name='test';
        $this->occasionRepo->shouldReceive('complete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('incomplete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcomplete')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteWork')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteHome')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteFreeTime')->andReturn($complete);
        $this->occasionRepo->shouldReceive('notcompleteSchool')->andReturn($complete);

        $this->occasionRepo->shouldReceive('organizerId')->with($id)->andReturn($id);
        $this->occasionRepo->shouldReceive('name')->with($id)->andReturn($name);
        $this->occasionRepo->shouldReceive('place')->with($id)->andReturn($place);
        $this->occasionRepo->shouldReceive('date')->with($id)->andReturn($date);
        $this->occasionRepo->shouldReceive('time')->with($id)->andReturn($time);

        $this->ocasionRepo->shouldReceive('occasion')->with($id)->andReturn($occasion);
        $this->occasionRepo->shouldReceive('pluck')->andReturn($array);

        View::shouldReceive('make')->with('events.edit', Mockery::any());

        $this->class->editOccasion();



    }

    /** @test */
    public function editOcc(){
        $id=4;
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        $time=\Carbon\Carbon::now()->format('H:i');
        $occasion=[
            'name'=>'test',
            'place'=>'testPlace',
            'date'=>$date,
            'time'=>$time,
            'organizer_id'=>4,

        ];
        $array=collect([1=>'email1@yahoo.com',2=>'email2@gmail.com',3=>'email3@hotmail.com'])->all();
        $users=[1=>'1',2=>'2'];
        $array1=["attached" => [],
                 "detached" => [],
                 "updated" => []
        ];
        $request = Mockery::mock(OcasionRequest::class);
        $request->shouldReceive('get')->with('eventId')->andReturn($id);
        $this->occasionRepo->shouldReceive('update')->with($request)->andReturn(true);
        $this->occasionRepo->shouldReceive('usersEmail')->andReturn($array);
        $request->shouldReceive('input')->andReturn();
        $this->occasionRepo->shouldReceive('syncUsers')->with($occasion, $users)->andReturn($array1);

        $user = factory(User::class) -> create();

        Mail::shouldReceive('send') -> once() -> with(
            'emails.event',
            Mockery::on( function( $data ){
                $this -> assertArrayHasKey( 'user', $data );
                return true;
            }),
            Mockery::on( function(\Closure $closure) use ($user){
                $mock = Mockery::mock('Illuminate\Mailer\Message');
                $mock -> shouldReceive('to') -> once() -> with( $user -> email )
                    -> andReturn( $mock ); //simulate the chaining
                $mock -> shouldReceive('subject') -> once() -> with('The subject');
                $closure($mock);
                return true;
            })
        );
        Redirect::shouldReceive('back')->andReturnSelf();

        $this->class->editOcc($request);
    }



    public function testExample()
    {
        $this->assertTrue(true);
    }
}
