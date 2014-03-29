@extends('layout')

@section('content')

<div class="row">
	<div class="span12 content">
		<div class="pull-right">
			<h3>Step 1/3 </h3>
		</div>
		<div class="login-box">
			<div class="regtitle">
				<h2>Hi! ...</h2>
			</div>

			<form class="form-horizontal" method="POST" action="{{ URL::action('UserController@store')}}" >
				<div class="">
					<label class="control-label">E-mail </label>
					<div class="">
						<input class="" type="text"  placeholder="Email" name="email">
						<span class="help-inline">{{ $errors->first('email') }}</span>
					</div>
				</div>

				<div class="control-group">
					<label class="">First Name </label>
					<div class="">
						<input class="" type="text" id=""  placeholder="First Name" name="firstname">
						<i class=''></i>
						<span class="help-inline">{{ $errors->first('firstname') }}</span>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Last Name </label>
						<div class="controls">
						<input class="" type="text"  placeholder="Last Name" name="lastname">
						<i class='icon-certificate'></i>
						<span class="help-inline">{{ $errors->first('lastname') }}</span>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Password </label>
					<div class="controls">
						<input class="" type="password" name="password"  placeholder="">
						<i class='icon-certificate'></i>
						<span class="help-inline">{{ $errors->first('password') }}</span>
					</div>
				</div>
	
				<div class="control-group">
					<label class="control-label">Re-type password </label>
					<div class="controls">
						<input class="" type="password" name="password_confirmation"  placeholder="">
						<i class='icon-certificate'></i>
						<span class="help-inline">{{ $errors->first('password_confirmation') }}</span>
					</div>
				</div>

				<div class="form-actions">
					<a href="" class="btn">Cancel</a>
					<button type="submit" class="btn btn-inverse">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>



