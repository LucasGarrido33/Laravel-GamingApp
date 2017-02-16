<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('user/profile', 'ProfileController', ['only' => [
    'show', 'edit', 'update'
]]);

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/players', 'PlayersController@index');

Route::get('/games', 'GameController@index');

Route::get('/game/{id}', 'GameController@show');


Route::get('/register/social', 'Auth\SocialAuthController@terminateRegister')->middleware('check.social');;

Route::post('/register/social/create','Auth\SocialAuthController@create')->middleware('check.social');

Route::get('/callback/{provider}', 'Auth\SocialAuthController@callback');

Route::get('/redirect/{provider}', 'Auth\SocialAuthController@redirect');

