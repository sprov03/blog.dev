<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">


      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>

      </button>
      <a class="navbar-brand" href="/">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav">
        {{-- <li><a href="{{{ action('HomeController@showProjectpage') }}}">My Projects Page</a></li> --}}
        <li><a href="{{{ action('HomeController@showAboutme') }}}">About Me</a></li>
        {{-- <li><a href="{{{ action('HomeController@showContactme') }}}">Contact Me</a></li> --}}
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://sprov03.surge.sh">Posts</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Users</a></li>
          </ul>
        </li>
        <li><a href="{{{ action('HomeController@showAboutme') }}}">LogIn</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>