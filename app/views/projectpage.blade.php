@extends('layouts.master')

@section('top-script')

@stop


@section('content')

	<h1>My Projects</h1>

	<a href="http://sprov03.surge.sh"><h4>Mario</h4>
	<p>I was told the best way to learn a laguage was to make a game with it.  What was ment was to make a card game, dice game, board game, or something of that nature.  Thats not what i heard.  So i started fexing my JavaScript by moving a div across the screen.  Three months later i have pushed my understanding of the language and functional programing to point that i was able to create a game similar to Mario Bros!!  I built the Game engine from scratch.  I Completly scraped my work at least 5 times along the way and started over from the gournd up.  Each time solving a key problem with the programing design.  After the thrid time i realized that conseptualy i was missing something so i asked an instructor look at my code and give me a push in the right direction.  I was designing the environment to handle every object in it.  Ben told me to try and get the objects to handle themselves and the environment to hanlde only what it needed to. This was around week four of programing with JavaScript.  Long Story Short.  Made the game in canvas because canvas is great at drawing things in.  Used requestframeanimation() to provide the loop requied to drive the game so that even old slow phones could handle the game. Problems arose and requied me to get time between frames to get the game to play the same on all devices. Another overhaul of the design.  Wanted buttons for the phone since there was no keyboard for aphone. Tryed to place a div on top of the canvas with click liseners on it and that faild because phone browsers suck.  Decided to just paint the buttons on the screen in canvas and have it listen to touch events.  Another Headache, there was an offset that i had to account for for the sides and the top.  Did not make since because the origin of refrence should have been the top left corner of the canvas for both drawing in canvas and the touch event since the listener was placed on the canvas element. Wrong!!! Found a workaroud after a crap ton of fighting it and was using grba colors to make the buttons transparent. Safari mobile would not diplay the buttons because Safari mobile sucks!! Had to change the colors to a solid gray instead. So many other obsticals that i had to over come to get this working.  Definatly a huge project to undertake for a new programer.</p></a>

@stop
