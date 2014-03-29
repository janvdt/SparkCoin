@extends('layout')

@include('instance.header')

@section('content')

<div>
	<div>
		<h1>{{$project->name}}</h1>
		<img src="{{$project->image}}"/>
		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<div>{{$project->description}}</div>
		<h3>{{$project->fundings}} fundings</h3>
		<h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3>
	</div>
	<div>
		<h2>Comments</h2>
		<img/>
		@foreach($project->comments as $comment)
			<div>{{$comment->profile_id}}</div>
			<div>{{$comment->body}}</div>
		@endforeach
		<h3>Add comment</h3>
		<div>	
			<ul>
		        @foreach($errors->all() as $error)
		            <li>{{ $error }}</li>
		        @endforeach
		    </ul>
		</div>
		{{Form::open(array('action'=>'CommentController@store', 'method'=>'post'))}}
		<div>
			{{Form::hidden('project_id',$project->id)}}
			{{Form::textarea('body')}}
		</div>
		<div>
			{{Form::submit('Post comment')}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop