@extends('layouts.master')



@section('top-script')
	
@stop



@section('content')

	<h1>Hello, Codeup!</h1>
	<br>
	<p>You Guessed: {{{ $quess }}}!!!</p>
	<br>
	<p>The Role is: {{{ $rand }}} !!!!</p>
	<br>
	<p>You are {{{ $message }}}!!!</p>
@stop



@section('bottom-script')

@stop