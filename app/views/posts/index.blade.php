@extends('layouts.master')

@section('top-script')

<style type="text/css">

.show_post{
	background:gray;
	border-radius: 15px;
	margin:30px;
}
.show_post:hover{
	background:#999;
}
.right{
	margin-right:20px;
}
.title{
	margin-left:25px;
	font-size: 2.2em;
}
.body{
	margin-left: 25px;
	margin-top: 30px;
	font-size: 1.6em;
}
.created{
	margin-top: 30px;
	font-size: 1em;
}


</style>

@stop


@section('content')

	<h1>Posts</h1>



@foreach( $posts as $post)


<a href="{{{ action('PostsController@findTitle', $post->title) }}}">
	<div class="row show_post">

		<div class="row">
			<h6 class="title">{{{ $post->title }}} By {{{ $post->user_id }}}</h6>
		</div>

		<div class="row">
			<p class="body">{{{ $post->body }}}</p>
		</div>

		<div class="row right">
			<span class="created">Created on {{{$post->created_at}}}</span>
		</div>

	</div>
</a>

@endforeach

{{ $posts->links() }}




@stop
