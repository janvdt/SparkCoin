@extends('layout')

@section('content')


	<div class="welcome">
		<a href="{{ URL::action('UserController@viewauthentication') }}">Login</a>
	</div>

