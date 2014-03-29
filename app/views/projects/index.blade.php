@extends('layout')

@include('instance.header')

@section('content')

<div>
	@foreach($projects as $project)
	<div>
		<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>
		<img src="{{$project->image}}"/>
		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<div>{{$project->description}}</div>
<<<<<<< HEAD
		<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
=======
		<h3>{{$project->fundings}} fundings</h3>
		<h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3>
>>>>>>> b6dfd66d5e239d9ac253a27e8277ee37c7f4c7ea
	</div>
	@endforeach
</div>
@stop