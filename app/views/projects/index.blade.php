@extends('layout')

@include('instance.header')

@section('content')

<div>
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
		<img src="{{$project->image}}"/>
		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<div>{{$project->description}}</div>
	@if($project->image != null)
		<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
	@endif
		<h3>{{$project->fundings}} fundings</h3>
		<h3>{{$project->views}} views</h3>
		<h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3>

	</div>
	@endforeach
</div>
@stop

@section('scripts')
<script type="text/javascript">
var projects = {{$projects}};
	$(document).ready(function(){
		$("#sort").change(function(e){
			var type = $("#sort").val();
			window.location.href = '/projects/sort/'+type;
		});
	});
</script>
@stop