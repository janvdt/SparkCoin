@extends('layout')

@include('instance.header')

@section('content')

<div>
	<div>
		<h1>{{$project->name}}</h1>
		<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
	</div>
</div>
@stop