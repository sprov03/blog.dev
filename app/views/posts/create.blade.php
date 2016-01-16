@extends('layouts.master')

@section('top-script')

@stop


@section('content')

	<h1>Create Post</h1>

	{{ Form::open(['action' => 'PostsController@store', 'class'=>'form-horizontal']) }}

		@include('partials.posts-form')

	{{ Form::close() }}

@stop