@extends('layouts.master')

@section('top-script')
<style type="text/css">

.show_level{
	background:gray;
	border-radius: 15px;
	margin:30px;
}
.show_level:hover{
	background:#999;
}
.right{
	margin-right:20px;
}
.id{
	margin-left:25px;
	font-size: 2.2em;
}
.level_name{
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

	<h1>Levels</h1>

<p>index page</p>

{{-- @foreach( $levels as $level) --}}


{{-- <a href="{{{ action('GamesController@show', $level->id) }}}">
	<div class="row show_level">

		<div class="row">
			<h6 class="id">{{{ $level->id }}} By </h6>
		</div>

		<div class="row">
			<p class="level_name">{{{ $level->level_name }}}</p>
		</div>

		<div class="row right">
			<span class="created">Created on {{{$level->created_at}}}</span>
		</div>

	</div>
</a>

@endforeach

{{ $levels->links() }} --}}




@stop

@section('bottom-script')

@stop
