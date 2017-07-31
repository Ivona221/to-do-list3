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
use App\Http\Controllers\TodoController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



   /* $file=request()->file('avatar');
    $name = $file->getClientOriginalName();
    Storage::disk('local')->put($name, $file);
    return back();*/

Route::group(['middleware' => 'auth'], function(){

    Route::get('/stats','TodoController@stats');

    Route::post('/check','TodoController@update')->name('date');

    Route::post('/search','TodoController@search');


    Route::get('/search/{date}','TodoController@byDate')->name('date');;

    Route::get('/up/{id}','TodoController@update2');

    Route::post('/search1','TodoController@search1');

    Route ::get('/events','EventController@index');

    Route::get('/event','EventController@show');

    Route::post('/eventAdd','EventController@store');

    Route::get('/send','TodoController@sendEmail');

    /*Route::get('/sendTest', function(){
        $user = \App\User::findOrFail(8);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {


            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });

        return "Success";
    });*/

    Route::get('/search1/{type}','TodoController@show3');


    Route::get('/todo','TodoController@index')->middleware('auth')->name('home');

    Route::post('/todoAdd','TodoController@create');

    Route::get('/todo/{date}','TodoController@show');


    Route::get('/search','TodoController@show2');



//Route::get('/todo/{date}/{value}','TodoController@check');

    Route::get('/todo/{date}/{value}','TodoController@check');



    Route::delete('/todo/{id}', function ($id) {
        \App\Todo::findOrFail($id)->delete();
        return back();

    });



    Route::get('edit/{id}','TodoController@editTodo')->name('edit');

    Route::get('/images','TodoController@image');

    Route::post('/avatars/{id}','TodoController@save');

    Route::post('/edit','TodoController@edit')->name('edit');

});



//Route::resource('todos', 'TodoController');
Route::resource('events', 'EventController');




Auth::routes();

Route::get('/home', 'HomeController@index');
