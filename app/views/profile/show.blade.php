@extends('layout')

@include('instance.header')
<div class="headerimage">
	<h1>MANAGE YOUR <span>IDEAS.</span></h1>
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