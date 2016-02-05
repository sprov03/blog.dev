@extends('layouts.master')

@section('top-script')
<style type="text/css">
canvas{
	background: white;
}
</style>
@stop


@section('content')

	@include('bread-crumbs.levels')

	<h1>Level {{{ $level->id }}}</h1>

	<input id="level_id" value="{{{ $level->id }}}"hidden>
	<input id="next_level" value=" {{{ $level->next_level }}} " hidden>

	<canvas id="canvas" height="300" width="300"></canvas>

@stop

@section('bottom-script')

	<script type="text/javascript" src="/js/baseEnvironment.js"></script>

@stop
