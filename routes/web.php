<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
//use Faker\Provider\File;

use Illuminate\Support\Facades\Mail;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

   /* $file=request()->file('avatar');
    $name = $file->getClientOriginalName();
    Storage::disk('local')->put($name, $file);
    return back();*/

Route::group(['middleware' => 'auth'], function(){

    Route::get('/stats','TodoController@stats');

    Route::post('/check','TodoController@update');

    Route::post('/search','TodoController@search');


    Route::get('/search/{date}','TodoController@byDate');

    Route::post('/search1','TodoController@search1');

    Route ::get('/events','EventController@index');

    Route::get('/event','EventController@show');

    Route::post('/eventAdd','EventController@store');

    Route::get('/send','TodoController@sendEmail');

    Route::get('/sendTest', function(){
        $user = \App\User::findOrFail(8);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {


            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });

        return "Success";
    });

    Route::get('/search1/{type}','TodoController@show3');


    Route::get('/todo','TodoController@index')->middleware('auth');

    Route::post('/todoAdd','TodoController@store');

    Route::get('/todo/{date}','TodoController@show');


    Route::get('/search','TodoController@show2');



//Route::get('/todo/{date}/{value}','TodoController@check');

    Route::get('/todo/{date}/{value}','TodoController@check');



    Route::delete('/todo/{id}', function ($id) {
        \App\Todo::findOrFail($id)->delete();
        return back();

    });

    Route::get('/images','TodoController@image');

    Route::post('/avatars/{id}',function($id){
        $imageTempName = request()->file('avatar')->getPathname();
        $imageName = request()->file('avatar')->getClientOriginalName();
        $path = base_path() . '/public/images';
        request()->file('avatar')->move($path , $imageName);
        DB::table('todos')
            ->where('id', $id)
            ->update(['image' => $imageName]);



        return back();
    });
});



