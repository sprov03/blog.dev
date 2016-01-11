<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', 'HomeController@showHome');

Route::get('/contactme', 'HomeController@showContactme');

Route::get('/aboutme', 'HomeController@showAboutme');

Route::get('/projectpage', 'HomeController@showProjectpage');

Route::get('/sayhello/{name?}', 'HomeController@showFirstView');

Route::get('/rolldice/{quess?}', 'HomeController@showRollDice');



Route::resource('/posts', 'PostsController');

Route::get('/games/play', 'GamesController@play');

Route::post('/games/create/{level}', 'GamesController@validateLevel');

Route::resource('/games', 'GamesController');
