@extends('layout')

@include('instance.header')

@section('content')

@include('profile.dashboard.header')

<ul>
	<li><a href="{{ URL::action('DocumentController@index') }}">Documents</a></li>
	<li><a href="{{ URL::action('GalleryController@index') }}">Your Galleries</a></li>
</ul>

@stop