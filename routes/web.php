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
use Laravel\Socialite\Facades\Socialite as Socialize;
use Illuminate\Support\Facades\Redis;


Route::get('/', function () {
    $visits=Redis::incr('visits');

    return view('welcome', compact('visits'));
    });

    Auth::routes();

    Route::group(['middleware' => 'auth, occasion'], function(){

    Route::post('/updateimg','TodoController@namechange');

    Route::get('/editProfile','HomeController@editProfile');

    Route::post('/changeTheName','HomeController@nameChange');

    Route::get('/stats','TodoController@stats');

    Route::post('/check','TodoController@update')->name('date');

    Route::post('/search','TodoController@search');

    Route::get('/search/{date}','TodoController@byDate');

    Route::get('/up/{id}','TodoController@update2');

    Route::post('/search1','TodoController@search1');

    Route ::get('/events','EventController@index');

    Route::get('/event','EventController@show');

    Route::get('/eventCreate','OcasionController@eventCreate')->name('ocasion')->middleware('sub');

    Route::post('/eventAdd','EventController@store');

    Route::get('/send','TodoController@sendEmail');

    Route::post('/eventNew','OcasionController@eventNew');

    Route::get('/allOccasions','OcasionController@show')->name('allOccasions');

    Route::delete('/occasion/{id}', function ($id) {

        Cache::forget('events_cache');
        \App\Ocasion::findOrFail($id)->delete();
        return back();

    });

    Route::get('/search1/{type}','TodoController@show3');

    Route::get('/todo','TodoController@index')->middleware('auth')->name('home');

    Route::post('/todoAdd','TodoController@create');

    Route::get('/todo/{date}','TodoController@show');

    Route::get('/search','TodoController@show2');

    Route::get('/todo/{date}/{value}','TodoController@check');

    Route::delete('/todo/{id}', function ($id) {
        \App\Todo::findOrFail($id)->delete();
        return back();

    });

    Route::get('edit/{id}','TodoController@editTodo')->name('edit');

    Route::get('edit/occasion/{id}','OcasionController@editOccasion')->name('editOccasion');

    Route::get('/images','TodoController@image');

    Route::post('/avatars/{id}','TodoController@save');

    Route::post('/edit','TodoController@edit');

    Route::post('/editOcc','OcasionController@editOcc');

    Route::get('/profile','HomeController@image');

    Route::post('/image','HomeController@upload');

    Route::post('/addmoney/stripe','OcasionController@validateStripe');

    Route::get('/subscription','HomeController@showSubscribe')->name('subscription');

    Route::post('/postSubscription', 'HomeController@postSubscription');

    Route::get('/cancelSubscription','HomeController@cancelSub');

    Route::post('/newSubImmediate','HomeController@newSub');

    Route::post('/newSubGold','HomeController@newSubGold');

    Route::post('/newSubDiamond','HomeController@newSubDiamond');

        Route::get('threads', 'ThreadsController@index');
        Route::get('threads/create', 'ThreadsController@create');
        Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
        Route::delete('threads/{channel}/{thread}', 'ThreadsController@destroy');
        Route::post('threads', 'ThreadsController@store');
        Route::get('threads/{channel}', 'ThreadsController@index');
        Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
        Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
        Route::patch('/replies/{reply}', 'RepliesController@update');
        Route::delete('/replies/{reply}', 'RepliesController@destroy');

        Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
        Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

        Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
        Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

        Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
        Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
        Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');

        Route::get('api/users', 'Api\UsersController@index');
        Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');

});

Route::resource('events', 'EventController');

Route::get('/home', 'HomeController@index');

Route::get('auth/{provider}', 'AuthController@redirectToProvider');

Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');







