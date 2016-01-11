<?php

class GamesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('games.create') ;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function validateLevel()
	{
		// $handle = fopen('../../public/js/testgame.js', 'w');
		$lines = explode('*', Input::get('csvString'));
		// echo Input::get('csvString') . PHP_EOL;
		//   new gameobject.background(x,y,width,height,'color');

		foreach($lines as $line)
		{
			$data = explode(',', $line);
			$JavaScript = "new gameObject.{$data[0]}({$data[1]},{$data[2]},{$data[3]},{$data[4]},'{$data[5]}');";
			echo $JavaScript . "<br>";
			// $fwrite($handle, $JavaScript . PHP_EOL);



		}

		// fclose($handle);
		// dd($_POST);
		die();
	}

	public function play()
	{
		return View::make('games.play') ;
	}



}
