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
#my_profile_pic{
  width:200px;
  height:200px;
  margin-left:30px;
  border-radius:50%;
}
p{
  margin:25px;
}
h3{
  margin:25px;
}
#github-repo{
  margin:25px;
}
li{
  list-style: none;
}
</style>

@stop


@section('content')


  <section class="row" id="splash_home">
    <h1>Let's Make a Game!!</h1>

    <ul class="right stylenone">
      <li class="home_links"><a href="{{{ action('LevelsController@index') }}}">Play</a></li>
      <li class="home_links"><a href="{{{ action('GamesController@create') }}}">Create<a/></li>
    </ul>
  </section>


  <section class="row radius" id="fetured_game_home">
    <h1>Some information on this project</h1>
    <a id="github-repo"href="https://github.com/sprov03/blog.dev">Github Repo for this project</a>

    <h3>Front End</h3>
      <p>I created a physics engine with vanilla javascript in order to learn how design a program
        that has an bunch of moving parts. After compleatly starting over from scratch the third time
        I asked an instructor at codeup what i was doing wrong.  I was trying to create an environment
        that did all the thinking for everything in it.  As a result every time i added a new feature 
        i had to redesign the the environment from the ground up.  I was told to try and have the objects
        control themselves and the environment simply be an environment. Three more compleate teardowns
        later and newmerous parial redesigns later i got it to work. I decided to make the game mobile
        friendly. ( <a href="http://sprov03.surge.sh">mobile version</a> )  This presented three big 
        problems, touch events, screen sizes, and slower processing. </p>

        <p>Touch events
          There is documention on touch events but not any good documentation that i could find about how
          to handle the tracking of them. The only documentation that i could find was how to target a 
          touch event.  I had to figure out how to solve the tracking of several touchevents at once and
          have the evnironment treat them the same as if they were key events</p>
        <p>Screen sizes
          Every device has different screen sizes.  I wanted the player to be the same size relitive to the
          canvas size and wanted him to move across the canvas at the same relitive speed on all devices.
          To acomplish this i created a canvas unit.  Simply a unit of length that is 1/100th the height of
          the canvas on any paticular device. I use this unit to convert the relitive sizes all everthing 
          in the canvas to pixels that reflext the apropriate relitive sizes. This also had to be used when
          calculating velocites because velocity is distance over time. The distance element is what makes
          it necessary.</p>
        <p>Slower processing
          On slower devices the game was very laggy. After some research i discovered request frame animation.
          it is designed for making animations smooth on slow devices and pausing animations when the tab is 
          not active. This caused another redisighn. I intially made the assumption that every frame refresh
          would represent 1 unit of time to simplify the equasions. In order to implement this i needed to 
          track the time beween frame request. and use this to modify my equasions for a smooth experiance on
          older phones. ( have not modified the y axis yet, x axis is working like a champ!! )
          The other unitended problem with request fram animation is that i pauses the game when the tab is 
          not active.  When it becomes active again the game would crash because of all the conflicting
          collisions that accoured over the period that of time when it was paused. To solve this issue i 
          captured the event that is trigered when a tab moved from active to inactive. Using this i was able
          to pause reset the timer and resume it when the tab became active again.</p>
    <h3>Back End</h3>
  </section>


  <section class="row radius" id="aboutme_home">
    <h1>Shawn Pivonka</h1>
    <img id="my_profile_pic" src="/img/hampton1-16_0115.jpg">
    <p>I am a recent graduate form Codeup.  This is a side project that i was working on while
      i was attending.</p>
      <ul>
        <li>Creative Problem Solving: 9/10</li>
        <li>Html: 6/10</li>
        <li>CSS: 6/10</li>
        <li>JavaScript: 6/10</li>
        <li>Jquery: 4/10</li>
        <li>Vue.js: 3/10</li>
        <li>Angular: 1/10</li>
        <li>PHP: 3/10</li>
        <li>Slim Framework: 2/10</li>
        <li>Laravel: 2/10</li>
        <li>Java: 1/10</li>
        <li>Python: 1/10</li>
      </ul>
  </section>
@stop
