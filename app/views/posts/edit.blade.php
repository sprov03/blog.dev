@extends('layouts.master')

@section('content')

	<h1>Edit Post</h1>

	{{ Form::model($post,['method' => 'PUT','action' => ['PostsController@update', $post->id], 'class' => 'form-horizontal']) }}

		@include('partials.posts-form')

	{{ Form::close() }}

@stop