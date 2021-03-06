@extends('layout')

@section('content')

<div class="row">
	<div class="span12 content">
		<div class="pull-right">
			<h3>Step 1/3 </h3>
		</div>
		<div class="login-box">
			<div class="regtitle">
				<h2>Hi! ING Customer</h2>
			</div>

			<form class="form-horizontal" method="POST" action="{{ URL::action('UserController@store')}}" >
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
						<input class="" type="password" name="password"  placeholder="">
						<span class="help-inline">{{ $errors->first('password') }}</span>
					</div>
				</div>
	
				<div class="">
					<label class="">Re-type password </label>
					<div class="">
						<input class="" type="password" name="password_confirmation"  placeholder="">
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



