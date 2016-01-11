@extends('layouts.master')

@section('top-script')


@stop


@section('content')

    <h1>Hello, {{{ $name }}}!</h1>
    @if ($name === 'shawn')
    	<h3>you rock</h3>
    @endif

    <a href="{{{ action('HomeController@showRollDice', array('1')) }}}">Guess one</a>
    <a href="{{{ action('HomeController@showRollDice', array('2')) }}}">Guess two</a>
    <a href="{{{ action('HomeController@showRollDice', array('3')) }}}">Guess three</a>
    <a href="{{{ action('HomeController@showRollDice', array('4')) }}}">Guess four</a>
    <a href="{{{ action('HomeController@showRollDice', array('5')) }}}">Guess five</a>
    <a href="{{{ action('HomeController@showRollDice', array('6')) }}}">Guess six</a>




@stop