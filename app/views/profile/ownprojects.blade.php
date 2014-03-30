@extends('layout')

@include('instance.header')

@section('content')



<div class="yourprojects">
	<h2>Your Own Projects</h2>
	@foreach($projects as $project)
		<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
		{{$project->name}}
		{{$project->name}}
	@endforeach
</div>