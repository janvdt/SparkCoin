@extends('layout')

@include('instance.header')

@section('content')

<div class="projects">
	{{Form::open()}}
	{{Form::label('sort','Sort by')}}
	@if($type != null)
		{{Form::select('sort', array('fundings' => 'Top rated', 'views' => 'Top viewed'), $type)}}
	@else
		{{Form::select('sort', array('fundings' => 'Top rated', 'views' => 'Top viewed'))}}
	@endif
	{{Form::close()}}
	@foreach($projects as $project)
	<div>
		<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>
		
		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<div>{{$project->description}}</div>
		@if($project->image != NULL)
		<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
		@endif
	
		@foreach($arrayfunds as $key=>$value)
		@if($project->id == $key)
		<h3>{{$value}} fundings</h3>
		@endif
		@endforeach
		<h3>{{$project->views}} views</h3>
		<h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3>
	</div>
	@endforeach
</div>
@stop

@section('scripts')
var projects = {{$projects}};
$("#sort").change(function(e){
	var type = $("#sort").val();
	window.location.href = '/projects/sort/'+type;
});
@stop