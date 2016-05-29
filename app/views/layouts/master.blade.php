<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Shawn Pivonka Gaming Blog</title>






		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">		
		<link rel="shortcut icon" href="/img/truck.jpg" />
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/mainBlog.css">

		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

		<script src="/js/bootstrap.min.js"></script>

		@yield('top-script')
	</head>
	<body id="body">
		@include('partials.navbar')
		<main id="main" class="container-fluid">

			@if (Session::has('successMessage'))
			    <div class="alert alert-success">{{{ Session::get('successMessage') }}}</div>
			@endif
			@if (Session::has('errorMessage'))
			    <div class="alert alert-danger">{{{ Session::get('errorMessage') }}}</div>
			@endif


			@yield('content')  {{-- is a placeholder --}}



			{{-- script tags for jquery and bootstrap --}}


		</main>
		@yield('bottom-script')
	</body>
</html>