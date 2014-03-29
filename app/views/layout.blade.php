<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js"></script>
	<script src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets/js/script.js"></script>
	<script src="/assets/js/jquery.form.js"></script>
	<link rel="stylesheet" href="/assets/js/bootstrap/css/bootstrap.min.css">

	<!-- Info -->
	<title>SparkCoin</title>
</head>

<body>
	<div class="container">
		@if(Session::has('message'))
			<p class="alert">{{ Session::get('message') }}</p>
		@endif
		@yield('content')

		@section('file')

		<footer class="site-footer">
			@yield('footer')
		</footer>
	</div>
	@yield('scripts')
</body>
</html>

