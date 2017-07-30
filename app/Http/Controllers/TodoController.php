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
use Illuminate\Support\Facades\Redirect;
use Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;





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
        $nowTime=$this->todos->time();
        $usrId=Auth::user()->id;



        return View::make('todo.index',compact('complete','incomplete', 'date', 'todos','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork','now','nowTime','usrId'));

    }

    /*public function showGameGeneralInformationForm($game_id = null, $dlc_ind = false)
    {
        $user = $this->user->getLoggedUser();
        $publisher = $this->user->getUserPublisherById($user->id);
        $tags = $this->tag->getActiveTagsAsArray();
        $platforms = $dlc_ind ? $this->game->getAllGamePlatforms($game_id)->pluck('name', 'platform_id')->toArray() : $this->platform->getAllPlatformsAsArray();
        $countries = $this->country->getAllCountriesAsArray();
        $platform_counter = 0;
        $active = 'active';
        $game_tags_ids = [];
        $tab_counter = 1;
        $sidebar_data = ['progress_steps' => [], 'show_game_countries_link_ind' => true];
        $readonly = '';
        $disabled = '';
        try {
            if($dlc_ind) {
                throw new GameNotFoundException();
            }
            $game = $this->game->getGameById($game_id);
            $game_platforms = $this->game->getAllGamePlatforms($game_id);
            $game_platform_countries = $this->game->getGamePlatformCountries($game_platforms);
            $game_tags_ids = $this->game->getGameTagsIds($game_id);
            $tab_counter = $game_platforms->count();
            $sidebar_data = $this->get_sidebar_data($game_id);
            $readonly = ($this->game->isGameSubmitted($game_id)) ? 'readonly' : '';
            $disabled = ($this->game->isGameSubmitted($game_id)) ? 'disabled' : '';
        } catch (GameNotFoundException $e) {
            $sidebar_data['remaining_questions_count'] = $this->question->getLatestVersionOfQuestionsByType()->count();
            $sidebar_data['steps_remaining'] = GameProgress::PROGRESS_STEP_NUMBER;
            $game = 'App\Models\Game';
            $platform = array_slice($platforms, 0, 1, true);
            $game_platforms[] = [
                'name'                      => current($platform),
                'platform_id'               => key($platform),
                'one_week_notification_ind' => 0,
                'release_date'              => Carbon::now()->addDay(),
                'id'                        => 1,
            ];
            $game_platform_countries[1] = [
                'game_platform_countries' => [],
            ];
        }
        JavaScript::put([
            'platforms'          => $platforms,
            'tabCounter'         => $tab_counter,
            'checkOriginalTitle' => URL::route('publisher.game.check.original.title'),
        ]);
        return View::make('publisher.game.general_information',
            array_merge(
                $sidebar_data,
                compact(
                    'publisher',
                    'tags',
                    'active',
                    'platforms',
                    'countries',
                    'game',
                    'game_id',
                    'game_platforms',
                    'game_tags_ids',
                    'platform_counter',
                    'game_platform_countries',
                    'progress_steps',
                    'remaining_questions_count',
                    'steps_remaining',
                    'readonly',
                    'disabled',
                    'dlc_ind'
                )
            )
        );
    }*/

    /*public function setUp()
    {
        parent::setUp();
        $this->gameQuestionModel = Mockery::mock(GameQuestion::class);
        $this->userModel = Mockery::mock(User::class);
        $this->userBLL = Mockery::mock(UserBLLInterface::class);
        $this->tag_BLL = Mockery::mock(TagBLLInterface::class);
        $this->gameBLL = Mockery::mock(GameBLLInterface::class);
        $this->platform_BLL = Mockery::mock(PlatformBLLInterface::class);
        $this->country_BLL = Mockery::mock(CountryBLLInterface::class);
        $this->gameType_BLL = Mockery::mock(GameTypeBLLInterface::class);
        $this->question = Mockery::mock(Question::class);
        $this->questionBLL = Mockery::mock(QuestionBLLInterface::class);
        $this->questionCategoryModel = Mockery::mock(QuestionsCategoryBLL::class);
        $this->questionsCategoryBLL = Mockery::mock(QuestionsCategoryBLL::class);
        $this->tag_model = Mockery::mock(Tag::class);
        $this->platformModel = Mockery::mock(Platform::class);
        $this->type_model = Mockery::mock(GameType::class);
        $this->track_model = Mockery::mock(GameTrack::class);
        $this->gameModel = Mockery::mock(Game::class);
        $this->countries_model = Mockery::mock(Countries::class);
        $this->platform_countries = Mockery::mock(GamePlatformCountry::class);
        $this->class = new GameController(
            $this->userBLL,
            $this->tag_BLL,
            $this->gameBLL,
            $this->platform_BLL,
            $this->country_BLL,
            $this->gameType_BLL,
            $this->questionBLL,
            $this->questionsCategoryBLL
        );
    }



    public function showGameGeneralInformationForm()
    {
        $user_id = 1;
        $game_id = null;
        $questionsCollection = new Collection([$this->question, $this->question]);
        $user = Mockery::mock(User::class); $user = $this->user->getLoggedUser();
        $publisher = Mockery::mock(Publisher::class);
        $platforms = [Mockery::mock(Platform::class), Mockery::mock(Platform::class)];
        $countries = [
            Mockery::mock(Countries::class),
            Mockery::mock(Countries::class),
            Mockery::mock(Countries::class),
        ];
        $tags = [$this->tag_model, $this->tag_model];
        $game_platform_countries[1] = ['game_platform_countries' => []];
        $gameNotFoundException = Mockery::mock(GameNotFoundException::class);
        $this->userBLL->shouldReceive('getLoggedUser')->once()->andReturn($user); $user = $this->user->getLoggedUser();
        $user->shouldReceive('getAttribute')->with('id')->once()->andReturn($user_id);
        $this->userBLL->shouldReceive('getUserPublisherById')->once()->with($user_id)->andReturn($publisher); $publisher = Mockery::mock(Publisher::class);
        $this->tag_BLL->shouldReceive('getActiveTagsAsArray')->once()->andReturn($tags);
        $this->platform_BLL->shouldReceive('getAllPlatformsAsArray')->once()->andReturn($platforms);
        $this->country_BLL->shouldReceive('getAllCountriesAsArray')->once()->andReturn($countries);
        $this->gameBLL->shouldReceive('getGameById')->once()->andThrow($gameNotFoundException);
        $this->questionBLL->shouldReceive('getLatestVersionOfQuestionsByType')->once()->andReturn($questionsCollection);
        JavaScriptFacade::shouldReceive('put');
        URL::shouldReceive('route')->once()->with('publisher.game.check.original.title');
        View::shouldReceive('make')->with('publisher.game.general_information', Mockery::any())->once();
        $this->class->showGameGeneralInformationForm();
    }*/



    public function create(TodoRequest $request)
    {

        //$todo=Auth::user()->todos()->create($request->all());

            $this->todos->create($request->all());
            //return redirect()->route('home');


         return back();

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

   /* public function show2(){
        return view('todo.index');
    }*/

    /*public function image(){
        return view('todo.images');
    }*/

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
        //$imageTempName = request()->file('avatar')->getPathname();
        $imageName = request()->file('avatar')->getClientOriginalName();
        $path = base_path() . '/public/images';
        request()->file('avatar')->move($path , $imageName);
        DB::table('todos')
            ->where('id', $id)
            ->update(['image' => $imageName]);
        return back();
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

    public function edit(TodoRequest $request){


        $id=request()->get('todoId');
        $todo=\App\Todo::findOrFail($id);
        $todo->update($request->all());
        return back();

    }

    public function editTodo($id){
        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();
        $todo=\App\Todo::findOrFail($id);
        $now=$this->todos->date();
        $nowTime=$this->todos->time();
        $usrId=Auth::user()->id;
        $date=\Carbon\Carbon::now()->format('Y-m-d');
        return view('todo.edit', compact('todo','now','nowTime', 'date','usrId','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));
}







}
