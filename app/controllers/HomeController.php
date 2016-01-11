<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showHome()
	{
		return View::make('home');
	}

	public function showContactme()
	{
		return View::make('contactme');
	}

	public function showAboutme()
	{
		return View::make('aboutme');
	}

	public function showProjectpage()
	{
		return View::make('projectpage');
	}

	public function showFirstView($name = 'shawn')
	{
		$data = array('name' => $name);
		return View::make('my-first-view', $data);
	}

	public function showRollDice($quess = 0)
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
	}

}
