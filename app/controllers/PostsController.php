<?php

class PostsController extends \BaseController {

	public function __construct()
	{
		parent::__construct();

		$this->beforeFilter('auth',['except' => ['index', 'show']]);
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Index View
	 */
	public function index()
	{
		$posts = Post::paginate(5);
		// if(!$post->count() === 0){
		// 	Session::flash('errorMessage', 'There were no results matching your search.');
		// }
		return View::make('posts.index')->with('posts',$posts);
	}

	/**
	 * Display the form for creating a new resource.
	 *
	 * @return Create Form
	 */
	public function create()
	{
		
		return View::make('posts.create') ;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return calls Validate and Save Method
	 */
	public function store()
	{
		$post = new Post();
		return $this->validateAndSave($post); 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return View::make('posts.show')->with('post',$post);
	 */
	public function show($id)
	{
		$post = Post::find($id);

		if(!$post){
			Session::flash('errorMessage', 'This post dose not exits');
			return $this->index();
		}
		return View::make('posts.show')->with('post',$post);
	}


	/**
	 * Display the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Edit post form
	 */
	public function edit($id)
	{
		$post = Post::find($id);
		return View::make('posts.edit')->with('post',$post);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return $this->validateAndSave($post);
	 */
	public function update($id)
	{
		$post = Post::find($id);
		return $this->validateAndSave($post);
	}

	/**
	 * Delete the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Redirect::action('PostsController@index');
	 */
	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		return $this->index();
	}

	/**
	 *	Find the specified resouce by the title.
	 *
	 *	@param string $title
	 *	@return View::make('posts.show')->with('post',$post);
	 */
	public function findTitle($title)
	{
		try {
			$post = Post::where('title', '=', $title)->firstOrFail();
			return View::make('posts.show')->with('post',$post);
		} catch (Exception $e) {
			
			Session::flash('errorMessage', '$e');
			return $this->index();
		}
	}

	/**
	 *	Validate and  Save the Post
	 *
	 *	@param Object $post
	 *	@return View::make('posts.show')->with('post',$post);
	 */
	private function validateAndSave($post)
	{
	    // create the validator
	    $validator = Validator::make(Input::all(), Post::$rules);
 
	    // attempt validation
	    if ($validator->fails()) {
	    	Session::flash('errorMessage','Invalid Submition');
	    	Log::warning('User input was not valid', Input::all() );
	    	return Redirect::back()->withInput()->withErrors($validator);
	    } else {

			$post->title = Input::get('title');
			$post->body = Input::get('body');
			$post->user_id = User::first()->id;

			$result = $post->save();

			if($result) {

				return View::make('posts.show')->with('post', $post);
			} else {
				Log::warning('an error accured ');
				return Redirect::action('PostsController@create')->withInput();
			}	    
		}
	}
}
