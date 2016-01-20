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

	public function fbtest()
	{
		$fb = new Facebook\Facebook([
  'app_id' => $_ENV['app_id'],
  'app_secret' => Hash::make($_ENV['app-secret']),
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
	}

	public function test()
	{
		return View::make('testvue');
		// dd();
	}

	public function testget()
	{
		$query = Level::with('calls')->where('id',9);
		// $query->whereHas('calls',function($q){
		// 	$q->where('level_id',9);
		// });
		$data = $query->get();
		return Response::json($data);
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

	public function login()
	{
		$user = User::find(1);
		Auth::login($user);
		return Response::json( Auth::user() );
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
