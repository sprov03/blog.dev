@extends('layouts.master')

@section('top-script')

@stop


@section('content')

	<h1>Create Post</h1>

<form class="form-horizontal"  action="{{{ action('PostsController@store') }}}" method="POST">
    <div class="form-group">
	    <label for="title" class="col-sm-2 control-label">Title</label>
	    <div class="col-sm-10">
	        <input type="text" class="form-control" id="title" name ="title" placeholder="Title"
	        value="{{{ Input::old('title') }}}">
	    </div>
    </div>
    <div class="form-group">
	    <label for="body" class="col-sm-2 control-label">Body</label>
	    <div class="col-sm-10">
	        <input type="text" class="form-control" id="body" name="body" placeholder="Body"
	        value="{{{Input::old('body') }}}">
	    </div>
    </div>
{{--     <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	  <div class="checkbox">
		<label>
		  <input type="checkbox"> Remember me
		</label>
	  </div>
	    </div>
    </div> --}}
    <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	  <button type="submit" class="btn btn-default">Sign in</button>
	    </div>
    </div>
</form>
@stop
