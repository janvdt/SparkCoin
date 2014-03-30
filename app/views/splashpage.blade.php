<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ING SPARK - FREE YOUR IDEAS</title>

	{{-- META SETTINGS --}}
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />


	
	{{-- STYLESHEETS --}}
	{{ HTML::style('http://fonts.googleapis.com/css?family=Oswald:400,300,700') }}
	{{ HTML::style('css/jquery.fullPage.css') }}
	{{ HTML::style('css/all.css') }}
</head>

<body>
	<div class="navigation">
				<div class="logo"><h1>SPARK</h1></div>
				<ul id="menu">
					<li data-menuanchor="home" class="homelink active"><a href="#home">HOME</a><div class='triangle'></div></li>
					<li data-menuanchor="info" class="infolink"><a href="#info">INFO</a><div class='triangle'></div></li>
					<li data-menuanchor="register" class="registerlink"><a href="#register">REGISTER</a><div class='triangle'></div></li>
				</ul>
			</div>
	<div class="section home">
	
		<div class="content home">
		
				<div class="login">
				<h1> A <span>SPARK</span> IS ALL IT TAKES.</h1>
					@if(Session::has('login_message'))
						<p class="alert">{{ Session::get('login_message') }}</p>
					@endif
					{{ Form::open( array( 'action'	=>'HomeController@postSignin', 'method'	=>'post' )) }}
						
						{{ Form::text( 'e-mail', '', array('name'=>'email', 'class'=>'txt-input', 'placeholder'=>'E-MAIL') ) }}
						{{ Form::password( 'username', array('name'=>'password', 'class'=>'txt-input', 'placeholder'=>'PASSWORD') ) }}

						<br><br>

						{{ Form::submit('LOG IN', array('class'=>'btn') ) }}

					{{ Form::close() }}
				</div>
			
			<div class="arrowBtnDown"></div>

		</div>


	</div>
	<div class="section info">
		<div  class="content info">
			<h1><span>FREE</span> YOUR IDEAS.</h1>
			<div class="infocontent">
				<div class="images">
					<img src="img/splashscreen/bulb.png" />
					<img class="arrowRight" src="img/splashscreen/arrowRight.png" />
					<img src="img/splashscreen/lightning.png" />
					<img class="arrowRight"src="img/splashscreen/arrowRight.png" />
					<img src="img/splashscreen/fire.png" />
				</div>
				<div class="text">
					<h3>It all starts with an idea, a concept, a plan.</h3>
					<h3 class='middle'>Let us give you the spark this project needs to turn into a flame. </h3>
					<h3>If your idea reaches its funding goal, you can collect the benefits provided by this platform.</h3>
				</div>
			</div>
			<div class="arrowBtnDown">
				
			</div>
		</div>

	</div>
	<div class="section register">
			<div  class="content register">
				<div class="registerForm">
					<h1><span>GET</span> STARTED.</h1>
					{{ Form::open( array( 'action'	=>'HomeController@postRegister', 'method'	=>'post' )) }}
						
						{{ Form::text( 'id', '', array('name'=>'id', 'class'=>'txt-input', 'placeholder'=>'ING ID') ) }}
						{{ Form::text( 'card-id', '', array('name'=>'card-id', 'class'=>'txt-input', 'placeholder'=>'CARD ID') ) }}
						{{ Form::text( 'email', '', array('name'=>'email', 'class'=>'txt-input', 'placeholder'=>'E-MAIL') ) }}
						{{ Form::password( 'password', array('name'=>'password', 'class'=>'txt-input', 'placeholder'=>'PASSWORD') ) }}
						{{ Form::password( 'password_confirmation', array('name'=>'password_confirmation', 'class'=>'txt-input', 'placeholder'=>'VERIFY PASSWORD') ) }}
						{{ Form::text( 'code', '', array('name'=>'code', 'class'=>'txt-input', 'placeholder'=>'CARD READER CODE') ) }}


						@if(Session::has('register_message'))
							<p class="alert">{{ Session::get('register_message') }}</p>
						@endif
						<br><br>

						{{ Form::submit('CREATE AN ACCOUNT', array('class'=>'btn') ) }}

					{{ Form::close() }}
				</div>
				<div class="cardReader">
					<h3>PLEASE TAKE YOUR <span>ING CARD READER</span></h3>
					<div class="reader"></div>
				</div>
			<div class="arrowBtnDown up"></div>

			</div>

	</div>
{{-- SCRIPTS --}}
	<!-- @section('scripts') -->
		{{ HTML::script('http://code.jquery.com/jquery-1.10.2.min.js') }}
		{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js') }}
		{{ HTML::script('js/plugins/fullPageJs.js') }}
		{{ HTML::script('js/plugins/home.js') }}

	<!-- @show -->
</body>
</html>