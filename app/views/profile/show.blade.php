@extends('layout')

@include('instance.header')

<div class="headerimage">
	<h1>MANAGE YOUR <span>IDEAS.</span></h1>
</div>

@section('content')
@include('profile.dashboard.header')

	<div class="yourprojects">
		@if(!empty($projects))
			@foreach($projects as $project)
		<div class="project">
			<div class="img" style="background-image: url({{ asset(''.$project->image->getSize('thumb')->getPathname().'') }})"></div>
				
				<h2>{{$project->name}}</h2>
				<p>{{$project->description}}</p>
		
		</div>
			@endforeach
		@endif
	</div>
<<<<<<< HEAD
	
=======
	<div class="yourfundings">
		

	</div>
	<div class="commentsonyourprojects">

	</div>
>>>>>>> 1ee66c6047b84625cb306f0d4f1b1edb00b88c15



@stop