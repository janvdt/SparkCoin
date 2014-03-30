@extends('layout')

@include('instance.header')

@section('content')

@include('profile.dashboard.header')

<ul>
	<li><a href="{{ URL::action('DocumentController@index') }}">Documents</a></li>
	<li><a href="{{ URL::action('MediaController@index') }}">Media</a></li>
</ul>

@stop