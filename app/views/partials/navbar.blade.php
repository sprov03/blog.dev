<link rel="stylesheet" href="/css/navbar.css">

<nav class="my_navbar">
	<ul>
		<li><a>Projects</a>
			<ul>
				<li><a>One
					{{-- <div id="google_maps" class="project"> --}}
							
						{{-- 	<div class="discribe_project">
								<h3>Custom Google Map Disigner</h3>
								<p>Any time i use google maps and have to learn a new feature of the api, I plan on including the feture in this interactive map maker. Which will return the code neccisary to plug it into your app</p>
								<a href="{{{ action('ProjectsController@showGoogleMapApi') }}}">Go To Page</a>
							</div>
					</div> --}}
				</a></li>
				<li><a>Two</a>
					<ul>
						<li><a href="{{{ action('ProjectsController@showGoogleMapApi') }}}"><div class="iframe_cover"></div><iframe class="iframe" src="{{{ action('ProjectsController@showGoogleMapApi') }}}/#preview_game" seamless="seamless" scrolling="no"></iframe></a></li>
					</ul>
				</li>
				<li><a>Three</a></li>
			</ul>
		</li>
		<li><a href="{{{ action('HomeController@showHome')}}}">Home</a></li>
		<li id="contact_me"><a href="{{{ action('HomeController@showContactme') }}}">Contact Me</a></li>
	</ul>
</nav>




























{{-- <nav class="navbar navbar-default">
	<div class="container-fluid">
 --}}    <!-- Brand and toggle get grouped for better mobile display -->
{{--     <div class="navbar-header">


			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>

			</button>
			<a class="navbar-brand" href="/">Home</a>
		</div> --}}

		<!-- Collect the nav links, forms, and other content for toggling -->
		{{-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> --}}
			

{{--
			Links Just to the right of the Home link
--}}
			{{-- <ul class="nav navbar-nav"> --}}
				{{-- <li><a href="{{{ action('HomeController@showProjectpage') }}}">My Projects Page</a></li> --}}
				{{-- <li><a href="{{{ action('HomeController@showAboutme') }}}">About Me</a></li> --}}
				{{-- <li><a href="{{{ action('HomeController@showContactme') }}}">Contact Me</a></li> --}}
{{--       </ul>

			<ul class="nav navbar-nav navbar-right">
 --}}
{{--
			Search bard
--}}
{{--         <li>
					<form action="{{{ action('PostsController@index') }}}" method="GET">
							<div class="form-group">
								<input id="search" placeholder="Search" name="search" type="text" class="form-inline form-control">
							</div>
					</form>
				</li>
 --}}
{{--
			Login and Logout
--}}
{{--         <li id="login_navbar">
					@if( Auth::check() )
						<a href="{{{ action('HomeController@getLogout') }}}">LogOut</a>
					@else
						<a href="{{{ action('HomeController@getLogin') }}}">LogIn</a>
					@endif
				</li>



				<li id="create_navbar"class="dropdown">
					<a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Create <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{{ action('PostsController@create') }}}">Write blog post</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{{ action('GamesController@create') }}}">Make New Level</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav> --}}