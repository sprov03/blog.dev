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

	public function test()
	{
		// $query = Post::with('user');

		// $query->whereHas('user',function($q){
		// 	$q->where('id','=',1);
		// });

		// $posts = Post::whereHas('user', function($q)
		// {
		//     $q->where('user_id', '=', 1);

		// })->get()[0]->user->user_name;

		// $l = Level::with('calls');
		// $l->whereHas('calls',function($q) {
		// 	$q->where('level_id', 1);
		// })->get();
		// $info = $l;
		// foreach ($info as $key => $value) {
		// 	# code...
		// }

		// $l = Level::with('calls')->find(1);
		// $l->calls->were('level_id',$l->id)->get();

		// $l->whereHas('calls',function($q) {
		// 	$q->where('level_id', 1);
		// });
		
		// $l = Level::find(1);
		// $calls = $l->call;
		// foreach ($calls as $call) {
			// echo $calls->id . "<br>";
		// }

		$query = Level::with('calls');
		$query->whereHas('calls',function($q){
			$q->where('level_id', 1);
		});
		$calls = $query->get();

		foreach ($calls as $call) {
			echo $call;
		}

		// echo $calls[0]->x;
		dd();
	}

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

	public function getLogin()
	{
		
		return View::make('login');
	}

	public function postLogin()
	{
		$email = Input::get('email');
		$password = Input::get('password');

		if (Auth::attempt(array('email' => $email, 'password' => $password))) {
		    return Redirect::intended('/');
		} else {
			Session::flash('errorMessage' , 'invalid username or password');
		    return Redirect::back();
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::action('HomeController@showHome');
	}
}
