@extends('layout')

@section('content')
<div class="navigation">
	<div class="logo"><h1>SPARK</h1></div>
	<ul id="menu">
		<li data-menuanchor="home" class="homelink active"><a href="#home">HOME</a><div class='triangle'></div></li>
		<li data-menuanchor="info" class="infolink"><a href="#info">INFO</a><div class='triangle'></div></li>
		<li data-menuanchor="register" class="registerlink"><a href="#register">REGISTER</a><div class='triangle'></div></li>
	</ul>
</div>
<div class="section">
	<div class="content home">
		<div class="login">
			<h1 class="margin-buffer-bottom">Step 2/2 </h1>
			<h1 class="margin-buffer margin-buffer-bottom">Biography</h1>
			<form class="form-horizontal" method="POST" action="{{ URL::action('ProfileController@store') }}">
				<label class=""><h2>Tell Something About yourself!</h2>  </label>
				<textarea class="" type="text" size="100" name="description" placeholder="Do your thing!" value=""></textarea>
				<span class="">{{ $errors->first('description') }}</span>

				{{ Form::hidden('image_id','',array('id' => 'selected-image-input')) }}
				@include('file.profile.upload')
				<div class="buttons">
					<a href="/" class="btn">Cancel</a>
					<button type="submit" class="btn">Save</button>
				</div>
			</div>
		</form>

	</div>
</div>
</div>