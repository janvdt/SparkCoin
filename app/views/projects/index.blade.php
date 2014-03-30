@extends('layout')

@include('instance.header')

@section('content')

<div class="projects">
	{{Form::open()}}
	{{Form::label('sort','Sort by')}}
	@if($type != null)
		{{Form::select('sort', array('total' => 'Top rated', 'views' => 'Top viewed'), $type)}}
	@else
		{{Form::select('sort', array('total' => 'Top rated', 'views' => 'Top viewed'))}}
	@endif
	{{Form::close()}}
	@foreach($projects as $project)
	<div class="single">
		<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>
		<div>{{$project->description}}</div>
		@if($project->image != NULL)
		<img src="{{asset('uploads/11/01_Changes_4.jpg')}}" >
		@endif
		@foreach($arrayfunds as $key=>$value)
		@if($project->id == $key)
		<h3>{{$value}} fundings</h3>
		@endif
		@endforeach
		<h3>{{$project->views}} views</h3>
		<h3>{{$project->capital}} start capital</h3>
		<h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3>
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