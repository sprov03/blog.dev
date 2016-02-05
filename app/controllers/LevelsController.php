<?php

class LevelsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$levels = Level::paginate(10);
		if(!$levels->count() === 0){
			Session::flash('errorMessage', 'There were no results matching your search.');
		}
		return View::make('/games/levels.index')->with('levels',$levels);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
		$data = Call::where('level_id',$id)->get();
		return Response::json($data);
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
		return 'editing a level is extreamy complex, not nearly as easy as editing a post. This feature is in the works';
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
		if ( Auth::check() ){

			$calls = Call::with('level_id', '=', $id);
			foreach($calls as $call)
			{
				$call->delete();
			}
			$level = Level::find($id);
			$level->delete();
			return $this->index();
		}
		return 'you are not authorized to do this';
	}


}
