<?php

class GamesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('games.show');
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
		// $validator = new Validator::make(Input::all(), ObjectsData::$rules);

		// if( $validator->fails())
		// {
		// 	return Redirect::back()->withInput()->withErrors($validator);
		// } else {
			// $oldData = ObjectsData::were('level_id', 1)->get();
			// dd($oldData);

			$lvl = new Level;
			$lvl->game_id = 1;
			$lvl->level_name = 'Test Levels';
			$lvl->save();

			$oldData = Call::where('level_id', $lvl->id)->get();

			foreach($oldData as $old)
			{
				$old->destroy($old->id);
			}


			$lines = explode('*', Input::get('csvString'));

			foreach($lines as $line)
			{
				$data = explode(',', $line);

				$submit = new Call;
				$submit->level_id = $lvl->id;
				$submit->function = $data[0];
				$submit->x = $data[1];
				$submit->y = $data[2];
				$submit->width = $data[3];
				$submit->height = $data[4];
				$submit->color = $data[5];

				$submit->save();
			}
			if ($submit)
			{
				return Redirect::action('GamesController@show', $lvl->id);
			} else {
				return Redirect::action('GamesController@create')->withInput();
			}
		// }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$level = Level::find($id);

		if(!$level){
			Session::flash('errorMessage', 'This level dose not exits');
			return $this->index();
		}
		return View::make('games.show')->with('level',$level);
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
}
