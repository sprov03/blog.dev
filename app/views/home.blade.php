@extends('layouts.master')

@section('top-script')
<style type="text/css">
.hidden{
  display: none;
}
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
#projects{
  background: #888888;
  padding: 30px;

}
#projects .project{
  height:300px;
  width: 100%;
  overflow: hidden;
  margin:5px;
}
#projects .project .iframe{
  width: 60%;
  height: 100%;
  overflow: hidden;
  border: none;
  float: left;
}
#projects .project .discribe_project{
  height: 100%;
  background:yellow;
  width:40%;
  float:right;
  position: relative;
}
#projects .project .discribe_project a{
  background: green;
  color:white;
  padding: 5px;
  position: absolute;
  left: 50%;
  transform: translateX( -50%);
  bottom: 15px;
}

.flashing_on{
  transition: all .5s;
  opacity: 1;
  font-size: 50px;
}
.flashing_off{
  transition: all .5s;
  opacity: .2;
  font-size: 35px;
}


</style>


@stop


@section('content')


  <section class="row" id="splash_home">
    <h1>Let's Make a Game!!</h1>

    <ul class="right stylenone">
      <li class="home_links"><a class="flashing_on" href="{{{ action('LevelsController@index') }}}">Play</a></li>
      <li class="home_links"><a class="flashing_on" href="{{{ action('GamesController@create') }}}">Create<a/></li>
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

  <section class="row radius hidden" id="projects">
    <h1>My Projects</h1>
    <div id="google_maps" class="project">
        <iframe class="iframe" src="{{{ action('ProjectsController@showGoogleMapApi') }}}" seamless="seamless" scrolling="no"></iframe>
        <div class="discribe_project">
          <h3>Custom Google Map Disigner</h3>
          <p>Any time i use google maps and have to learn a new feature of the api, I plan on including the feture in this interactive map maker. Which will return the code neccisary to plug it into your app</p>
          <a href="{{{ action('ProjectsController@showGoogleMapApi') }}}">Go To Page</a>
        </div>
    </div>
    <div class="project">
        <iframe class="iframe" src="{{{ action('HomeController@showAboutme') }}}" seamless="seamless" scrolling="no"></iframe>
        <div class="discribe_project">
          <h3>About Me</h3>
          <p>some basic stuff about me</p>
          <a href="{{{ action('HomeController@showAboutme') }}}">Go To Page</a>
        </div>
    </div>
    <div class="project hidden"></div>
    <div class="project hidden"></div>
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

@section('bottom-script')
<script>
var flashing_on = document.getElementsByClassName('flashing_on');
var flashing_off = document.getElementsByClassName('flashing_off');

setInterval( function(){
  var totOn = flashing_on.length;
  var totOff = flashing_off.length;

  for(var i = 0; i < totOn; i++){
     flashing_on.item(0).className = 'flashing_off';
  }
  for(var i = 0; i < totOff; i++){
     flashing_off.item(0).className = 'flashing_on';
  }
}, 500);



</script>
@stop