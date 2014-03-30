@extends('layout')

@include('instance.header')
<div class="dashboard">
	<h1>Good morning, <span>{{$user->firstname}}</span></h1>
	<img src="">
</div>
@section('content')
@include('profile.dashboard.header')

	<div class="yoursparks">
		<h2>Manage your Sparks</h2>
		<p>You have {{$profile->spark->value}} Sparkieeez </p>
	</div>
	<div class="yourprojects">
		<h2>Your projects</h2>
		@if(!empty($projects))
			@foreach($projects as $project)
				<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
				{{$project->name}}
				{{$project->description}}
			@endforeach
		@endif
	</div>
	<div class="yourfundings">

	</div>
	<div class="commentsonyourprojects">

	</div>



@stop