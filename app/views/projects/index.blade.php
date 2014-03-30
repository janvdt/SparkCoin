@extends('layout')

@include('instance.header')
<div class="headerimage">
	<h1>DREAM <span>BIG</span>, ACT <span>NOW</span></h1>
</div>

@section('content')
<div class="projects">
<!-- 	{{Form::open()}}
	{{Form::label('sort','Sort by')}}
	@if($type != null)
		{{Form::select('sort', array('total' => 'Top rated', 'views' => 'Top viewed'), $type)}}
	@else
		{{Form::select('sort', array('total' => 'Top rated', 'views' => 'Top viewed'))}}
	@endif
	{{Form::close()}} -->
	<div class="headerProject">
		<h1>TOP PROJECTS</h1>
		<a href="#">View more...</a>
	</div>
	@foreach($projects as $project)

	<div class="single">
		<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>

		<!-- <img src="{{ asset(''.$project->image->getSize('thumb')->getPathname().'') }}"/> -->
		<div class="img" style="background-image: url({{ asset(''.$project->image->getSize('thumb')->getPathname().'') }})"></div>
<!-- 		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<div>{{$project->description}}</div> -->
	
		@foreach($arrayfunds as $key=>$value)
		@if($project->id == $key)
		<div class='fundings'> <div class="icon funding"></div><h3>{{$value}}</h3></div>
		@endif
		@endforeach
		<div class="views"><div class="icon "></div><h3>{{$project->views}} </h3></div>
		<div class="capital"><h3>{{$project->capital}} START CAPITAL</h3></div>
		<div class="expiredate"><h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3></div>
		<div class="progress-bar {{$project->id}}">
			<span></span>
		</div>
	</div>
	@endforeach
		<div class="headerProject margin">
			<h1>MOST VIEWED</h1>
			<a href="#">View more...</a>
		</div>
		@foreach($projects as $project)

		<div class="single">
			<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>

			<!-- <img src="{{ asset(''.$project->image->getSize('thumb')->getPathname().'') }}"/> -->
			<div class="img" style="background-image: url({{ asset(''.$project->image->getSize('thumb')->getPathname().'') }})"></div>
	<!-- 		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
			<div>{{$project->description}}</div> -->
		
			@foreach($arrayfunds as $key=>$value)
			@if($project->id == $key)
			<div class='fundings'> <div class="icon funding"></div><h3>{{$value}}</h3></div>
			@endif
			@endforeach
			<div class="views"><div class="icon "></div><h3>{{$project->views}} </h3></div>
			<div class="capital"><h3>{{$project->capital}} START CAPITAL</h3></div>
			<div class="expiredate"><h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3></div>
			<div class="progress-bar {{$project->id}}">
				<span></span>
			</div>
		</div>
		@endforeach
			<div class="headerProject margin">
				<h1>RECENT PROJECTS</h1>
				<a href="#">View more...</a>
			</div>
			@foreach($projects as $project)

			<div class="single">
				<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>

				<!-- <img src="{{ asset(''.$project->image->getSize('thumb')->getPathname().'') }}"/> -->
				<div class="img" style="background-image: url({{ asset(''.$project->image->getSize('thumb')->getPathname().'') }})"></div>
		<!-- 		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
				<div>{{$project->description}}</div> -->
			
				@foreach($arrayfunds as $key=>$value)
				@if($project->id == $key)
				<div class='fundings'> <div class="icon funding"></div><h3>{{$value}}</h3></div>
				@endif
				@endforeach
				<div class="views"><div class="icon "></div><h3>{{$project->views}} </h3></div>
				<div class="capital"><h3>{{$project->capital}} START CAPITAL</h3></div>
				<div class="expiredate"><h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3></div>
				<div class="progress-bar {{$project->id}}">
					<span></span>
				</div>
			</div>
			@endforeach
</div>
@stop

@section('scripts')
var projects = {{$projects}};
for(index in projects){
	if(projects[index].total != 0){
		var projectWidth = projects[index].total / projects[index].capital * 100;
	}
	else{
		var projectWidth = 0;
	}
	console.log(projectWidth);
	$('.'+projects[index].id+' span').css({'width':projectWidth+'%'});
}

$("#sort").change(function(e){
	var type = $("#sort").val();
	window.location.href = '/projects/sort/'+type;
});
@stop