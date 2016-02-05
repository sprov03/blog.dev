@extends('layouts.master')

@section('top-script')
<style type="text/css">
canvas{
	background: white;
}
</style>
@stop


@section('content')

	<a href="{{{ action( 'HomeController@showHome' ) }}}">Home</a>

	<h1>Test Level</h1>

	<input id="level_id" value="{{{ $level->id }}}"hidden>

	<canvas id="canvas" height="300" width="300"></canvas>

@stop

@section('bottom-script')

	<script type="text/javascript" src="/js/baseEnvironment.js"></script>

@stop
