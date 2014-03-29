<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ING SPARK</title>

	{{-- META SETTINGS --}}
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />


	
	{{-- STYLESHEETS --}}
	{{ HTML::style('http://fonts.googleapis.com/css?family=Oswald:400,300,700') }}
	{{ HTML::style('css/all.css') }}
</head>

<body>
	<div class="navigation">
		<div class="logo"></div>
			<ul>
				<li><a href="#">HOME</a></li>
				<li><a href="#">INFO</a></li>
				<li><a href="#">REGISTER</a></li>
			</ul>
	</div>
	<div class="section home">
		<div class="content home">
			<h1> A <span>SPARK</span> IS ALL IT TAKES.</h1>
		</div>
		
	</div>
	<div class="section info">

	</div>
	<div class="section register">
		<form class="form-horizontal" method="POST" action="{{ URL::action('UserController@store')}}" >
			<div class="">
				<label class="">ING ID </label>
				<div class="">
					<input class="" type="text"  placeholder="ING ID" name="ingid">
					<span class="help-inline">{{ $errors->first('ingid') }}</span>
				</div>
				</div>
				<div class="">
					<label class="">CARD ID </label>
					<div class="">
						<input class="" type="text"  placeholder="CARDID" name="cardid">
						<span class="help-inline">{{ $errors->first('cardid') }}</span>
					</div>
				</div>
				<div class="">
					<label class="">E-mail </label>
					<div class="">
						<input class="" type="text"  placeholder="Email" name="email">
						<span class="help-inline">{{ $errors->first('email') }}</span>
					</div>
				</div>

				<div class="">
					<label class="">First Name </label>
					<div class="">
						<input class="" type="text" id=""  placeholder="First Name" name="firstname">
						<i class=''></i>
						<span class="help-inline">{{ $errors->first('firstname') }}</span>
					</div>
				</div>

				<div class="">
					<label class="">Last Name </label>
						<div class="">
						<input class="" type="text"  placeholder="Last Name" name="lastname">
						<span class="help-inline">{{ $errors->first('lastname') }}</span>
					</div>
				</div>

				<div class="">
					<label class="">Password </label>
					<div class="">
						<input class="" type="password" name="password"  placeholder="PASSWORD">
						<span class="help-inline">{{ $errors->first('password') }}</span>
					</div>
				</div>
	
				<div class="">
					<label class="">Re-type password </label>
					<div class="">
						<input class="" type="password" name="password_confirmation"  placeholder="VERIFY PASSWORD">
						<span class="help-inline">{{ $errors->first('password_confirmation') }}</span>
					</div>
				</div>
				<div class="">
					<label class="">Card Reader Code </label>
					<div class="">
						<input class="" type="text"  placeholder="CARD READER CODE" name="cardreadercode">
						<span class="help-inline">{{ $errors->first('cardreadercode') }}</span>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-inverse">Create an Account</button>
				</div>
			</form>
	</div>

</body>
</html>