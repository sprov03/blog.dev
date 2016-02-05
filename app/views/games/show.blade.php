@extends('layouts.master')

@section('top-script')
<style type="text/css">
canvas{
	background: white;
}
</style>
@stop


@section('content')

	@include('bread-crumbs.index')

	<h1>Test Level</h1>

	<input id="level_id" value="{{{ $level->id }}}"hidden>

	<canvas id="canvas" height="300" width="300"></canvas>

@stop

@section('bottom-script')

	<script type="text/javascript" src="/js/baseEnvironment.js"></script>

@stop
