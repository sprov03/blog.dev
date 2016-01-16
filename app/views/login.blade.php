@extends('layouts.master')

@section('content')

	<h1>Log in</h1>

	{{ Form::open(['method' => 'POST','action' => ['HomeController@postLogin'], 'class' => 'form-horizontal']) }}
{{-- 
        Email Input Field
 --}}
		<div class="form-group">
		    {{ $errors->first('email', '<span class="help-block col-sm-offset-1 ">:message</span>') }}
			{{ Form::label('email', 'Email',['class' => 'col-sm-offset-3 col-sm-1 control-lablel right']) }}
		    <div class="col-sm-4">
		    	{{ Form::text('email', null, ['class'=>'form-control','placeholder'=>'Email'])}}
		    </div>
		</div>


{{-- 
        Password Input Field
 --}}
		<div class="form-group">
		    {{ $errors->first('password', '<span class="help-block col-sm-offset-1 ">:message</span>') }}
			{{ Form::label('password', 'Password',['class' => 'col-sm-offset-3 col-sm-1 control-lablel right']) }}
		    <div class="col-sm-4">
		    	{{ Form::password('password',['class'=>'form-control','placeholder'=>'Password'])}}
		    </div>
		</div>

{{--
        Submit Button
--}} 
		<div class="form-group center">
		    {{ Form::submit('Submit Form',['class'=>'btn btn-default']) }}
		</div>
	

	{{ Form::close() }}

@stop