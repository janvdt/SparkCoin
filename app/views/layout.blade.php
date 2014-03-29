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

		</footer>
	</div>
	@section('scripts')
</body>
</html>

