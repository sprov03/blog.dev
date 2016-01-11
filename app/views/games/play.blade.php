@extends('layouts.master')

@section('top-script')
<style type="text/css">
canvas{
	background: white;
}
</style>
@stop


@section('content')

	<h1>Test Level</h1>

	<canvas id="canvas" height="300" width="300"></canvas>

@stop

@section('bottom-script')

<script type="text/javascript" src="/js/baseEnvironment.js"></script>

<script type="text/javascript" src="/js/testgame.js"></script>

@stop
