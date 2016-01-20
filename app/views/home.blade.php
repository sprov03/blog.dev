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



{{--  JS FB Stuff below --}}



<script>
//   // This is called with the results from from FB.getLoginStatus().
//   function statusChangeCallback(response) {
//     console.log('statusChangeCallback');
//     console.log(response);
//     // The response object is returned with a status field that lets the
//     // app know the current login status of the person.
//     // Full docs on the response object can be found in the documentation
//     // for FB.getLoginStatus().
//     if (response.status === 'connected') {
//       // Logged into your app and Facebook.
//       testAPI();
//       // to log user into our app
//       // i made this function
//       loginUser();
//     } else if (response.status === 'not_authorized') {
//       // The person is logged into Facebook, but not your app.
//       document.getElementById('status').innerHTML = 'Please log ' +
//         'into this app.';
//     } else {
//       // The person is not logged into Facebook, so we're not sure if
//       // they are logged into this app or not.
//       document.getElementById('status').innerHTML = 'Please log ' +
//         'into Facebook.';
//     }
//   }

//   // This function is called when someone finishes with the Login
//   // Button.  See the onlogin handler attached to it in the sample
//   // code below.
//   function checkLoginState() {
//     FB.getLoginStatus(function(response) {
//       statusChangeCallback(response);
//     });
//   }

//   window.fbAsyncInit = function() {
//   FB.init({
//     appId      : '2213269502147108',
//     cookie     : true,  // enable cookies to allow the server to access 
//                         // the session
//     xfbml      : true,  // parse social plugins on this page
//     version    : 'v2.2' // use version 2.2
//   });

//   // Now that we've initialized the JavaScript SDK, we call 
//   // FB.getLoginStatus().  This function gets the state of the
//   // person visiting this page and can return one of three states to
//   // the callback you provide.  They can be:
//   //
//   // 1. Logged into your app ('connected')
//   // 2. Logged into Facebook, but not your app ('not_authorized')
//   // 3. Not logged into Facebook and can't tell if they are logged into
//   //    your app or not.
//   //
//   // These three cases are handled in the callback function.

//   FB.getLoginStatus(function(response) {
//     statusChangeCallback(response);
//   });

//   };

//   // Load the SDK asynchronously
//   (function(d, s, id) {
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) return;
//     js = d.createElement(s); js.id = id;
//     js.src = "//connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
//   }(document, 'script', 'facebook-jssdk'));

//   // Here we run a very simple test of the Graph API after login is
//   // successful.  See statusChangeCallback() for when this call is made.
//   function testAPI() {
//     console.log('Welcome!  Fetching your information.... ');
//     FB.api('/me', function(response) {
//       console.log('Successful login for: ' + response.name);
//       console.log(response);
//       document.getElementById('status').innerHTML =
//         'Thanks for logging in, ' + response.name + '!';
//     });
//   }
//   function loginUser()
//   {
//   	$.get("/login/users").done(function(data) {
//         // console.log(data);
//     });
//   }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

{{-- <fb:login-button scope="public_profile,email,user_friends" onlogin="checkLoginState();">
</fb:login-button> --}}


{{--  JS FB Stuff above  --}}

{{--  PHP FB Stuff below --}}












<div id="status">
</div>

	<section class="row" id="splash_home">
		<h1>Let's Make a Game!!</h1>

		<ul class="right stylenone">
			<li class="home_links"><a href="{{{ action('GamesController@index') }}}">Games</a></li>
			<li class="home_links"><a href="{{{ action('PostsController@index') }}}">Posts<a/></li>
		</ul>
	</section>


	<section class="row radius" id="fetured_game_home">
		<h1>Featured Game Of The Week</h1>

		<p>Display the game info</p>

      <div
        class="fb-like"
        data-share="true"
        data-width="450"
        data-show-faces="true">
      </div>

	</section>


	<section class="row radius" id="aboutme_home">
		<h1>Shawn Pivonka</h1>
		<p>Im awsome</p>
	</section>

@stop
