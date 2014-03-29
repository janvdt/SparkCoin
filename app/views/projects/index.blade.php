@extends('layout')

@include('instance.header')

@section('content')

<div>
	@foreach($projects as $project)
	<div>
		<h1>{{$project->name}}</h1>
		<div>{{$project->description}}</div>
	</div>
	@endforeach
</div>
@stop