@extends('layouts.master')

@section('top-script')

<style type="text/css">

#show_post{
	background:gray;
	border-radius: 15px;
}
#title{
	margin-left:25px;
	font-size: 2.2em;
}
#body{
	margin-left: 25px;
	margin-top: 30px;
	font-size: 1.6em;
}
#created{
	margin: 30px;
	font-size: 1em;
}
#edit{

}



</style>

@stop


@section('content')

	<h1>POST</h1>

	<div id="show_post" class="row">

		<div class="row">
			<h6 id="title">{{{ $post->title }}} By UserName</h6>
		</div>

		<div class="row">
			<p id="body">{{{ $post->body }}}</p>
		</div>

		<div class="row">
			<div class="col-xs-6 left">
				<a href="{{{ action('PostsController@edit', $post->id) }}}">{{ Form::submit('Edit',['class'=>' btn btn-xs btn-default']) }}</a>

				{{ Form::open(['action'=>['PostsController@destroy',$post->id], 'method'=>'DELETE']) }}
					{{ Form::submit('Delete',['class'=>'btn btn-xs btn-danger'])}}
				{{ Form::close()}}
			</div>
			<div class="col-xs-6 right">
				<span class="right" id="created">Created {{{$post->created_at}}}</span>
			</div>
		</div>

	</div>

@stop
