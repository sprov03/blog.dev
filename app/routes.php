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

/*
 *	home
 */
Route::get('/test', 'HomeController@test');
Route::get('/login', 'HomeController@getLogin');
Route::post('/login', 'HomeController@postLogin');
Route::get('/logout', 'HomeController@getLogout');
Route::get('/', 'HomeController@showHome');

/*
 *	posts
 */
Route::get('/posts/title/{title}', "PostsController@findTitle");
Route::resource('/posts', 'PostsController');

/*
 *	levels
 */
Route::resource('/games/levels', 'LevelsController');

/*
 *	games
 */
// Route::get('/games/level/{level}', 'GamesController@getLevel');
Route::resource('/games', 'GamesController');

/*
 *	aboutme
 */
Route::get('/aboutme/contactme', 'HomeController@showContactme');
Route::get('/aboutme', 'HomeController@showAboutme');

/*
 *	tags
 */
Route::resource('tags', 'TagsController');

/*
 *	Practice Routes
 */
Route::get('/projectpage', 'HomeController@showProjectpage');
Route::get('/sayhello/{name?}', 'HomeController@showFirstView');
Route::get('/rolldice/{quess?}', 'HomeController@showRollDice');