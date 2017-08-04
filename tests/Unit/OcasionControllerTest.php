<?php

namespace Tests\Unit;

use App\Http\Requests\OcasionRequest;
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
        $this->occasionRepo = Mockery::mock(OcasionRepository::class);
        $this->class = new OcasionController($this->occasionRepo);
        $this->todo=Mockery::mock(Ocasion::class);

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
    public function eventNew(){
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


        $email=['ivonamilanova@yahoo.com', 'ross@friends.com'];

        $this->occasionRepo->shouldReceive('create')->with($occasion)->andReturn(true);

        $request = Mockery::mock(OcasionRequest::class);
        $request->shouldReceive('all')->andReturn($occasion);
        $request->shouldReceive('get')->with('users')->andReturn((object)$users);

        $this->occasionRepo->shouldReceive('attachPart')->with((object)$users, true)->andReturn(true);
        $this->occasionRepo->shouldReceive('userMail')->with((object)$occasion)->andReturn($email);
        $array=['occasion' => 'someName', 'place' => 'somePlace', 'time' => \Carbon\Carbon::now()->format('Y-m-d'), 'date' => \Carbon\Carbon::now()->format('H:i')];
        //Mail::shouldReceive('send')->with('emails.event', Mockery::any());
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
    }



    public function testExample()
    {
        $this->assertTrue(true);
    }
}
