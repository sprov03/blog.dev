@extends('layouts.master')

@section('top-script')
<style type="text/css">
#splash_home{
	background-image: url("../img/splash2.jpg");
	background-width: 100%;
	height:500px;
	border-radius: 15px;
	text-align: center;
	font-family: arcade; 
}
#fetured_game_home{
	background:blue;
}
#aboutme_home{
	background: orange;
}


.home_links{
	font-size: 3.5em;
	margin-right:30px;
	padding-right:20px;
	padding-top:60px;
}

</style>

@stop


@section('content')


  <section class="row" id="splash_home">
    <h1>Let's Make a Game!!</h1>

    <ul class="right stylenone">
      <li class="home_links"><a href="{{{ action('GamesController@show', 3) }}}">Play Games</a></li>
      <li class="home_links"><a href="{{{ action('GamesController@create') }}}">Create Levels<a/></li>
    </ul>
  </section>


  <section class="row radius" id="fetured_game_home">
    <h1>Featured Game Of The Week</h1>

    <p>Display the game info</p>
  </section>


  <section class="row radius" id="aboutme_home">
    <h1>Shawn Pivonka</h1>
    <p>Im awsome</p>
  </section>
@stop
