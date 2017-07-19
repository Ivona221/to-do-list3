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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/todo','TodoController@index')->middleware('auth');

Route::post('/todoAdd','TodoController@store');

Route::get('/todo/{date}','TodoController@show');

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
   /* $file=request()->file('avatar');
    $name = $file->getClientOriginalName();
    Storage::disk('local')->put($name, $file);
    return back();*/




Route::get('/stats','TodoController@stats');

Route::post('/check','TodoController@update');

Route::post('/search','TodoController@search');

Route ::get('/events','EventController@index');

Route::get('/event','EventController@show');

Route::post('/eventAdd','EventController@store');

Route::get('/send','TodoController@sendEmail');
