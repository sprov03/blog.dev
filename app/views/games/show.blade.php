@extends('layouts.master')

@section('top-script')
<style type="text/css">
canvas{
	background: white;
}	
#main{
	padding: 0;
	width: 95%;
}
#preview_game{
	position: relative;
	top: 10px;
}

</style>
@stop


@section('content')

	@include('bread-crumbs.levels')

	<h1>Level {{{ $level->id }}}</h1>
	<p>enter to fire, arrows to move, spacebar to jump</p>

	<input id="level_id" value="{{{ $level->id }}}"hidden>
	<input id="next_level" value=" {{{ $level->next_level }}} " hidden>
	<div id="preview_game"></div>
	<canvas id="canvas" height="300" width="300"></canvas>

@stop

@section('bottom-script')

	<script type="text/javascript" src="/js/baseEnvironment.js"></script>

@stop
