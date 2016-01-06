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

Route::get('/', function()
{
	return View::make('home');
});

Route::get('/sayhello/{name?}', function($name = null)
{
	$data = array('name' => $name);
	return View::make('my-first-view')->with($data);
});

Route::get('/rolldice/{quess?}', function($quess = '0') 
{
	$message;
	$rand = mt_rand(1,20);
	if (strVal($rand) === $quess){
		$message = 'Right';
	} else{
		$message = 'Wrong';
	}

	$data = array('quess' => $quess,'message' => $message,'rand' => $rand);
	return View::make('roll-dice')->with($data);
});