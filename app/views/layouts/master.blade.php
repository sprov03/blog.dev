<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Shawn Pivonka Resume</title>






		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">		
		<link rel="shortcut icon" href="/img/truck.jpg" />
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/mainBlog.css">

		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

		<script src="/js/bootstrap.min.js"></script>
		{{-- <link> --}}








		{{-- meta data --}}




		@yield('top-script')
	</head>
	<body>
		@include('partials.navbar')
		<main id="main" class="container">


			@yield('content')  {{-- is a placeholder --}}



			{{-- script tags for jquery and bootstrap --}}


		</main>
		@yield('bottom-script')
	</body>
</html>