@extends('layout')

@include('instance.header')

@section('content')

<div>
	<div>
		<h1>{{$project->name}}</h1>
		<h3>by Bart Moons</h3>
		{{Form::open(array('action'=>'FundController@postFund', 'method'=>'post'))}}
		{{Form::hidden('project_id',$project->id)}}
		{{Form::label('value','Value to fund')}}
		{{Form::text('value')}}
		{{Form::submit('Fund this project')}}
		{{Form::close()}}
	@if($project->image != null)
		<img src="/{{ $project->image->getSize('thumb')->getPathname() }}" >
	@endif
		<img src="{{$project->image}}"/>
		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<div>{{$project->description}}</div>
		<h3>{{$fund_total}} sparkcoins</h3>
		<h3>{{$project->views}} views</h3>
		<h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3>
	</div>
	<div>
		<h2><?php echo count($project->comments) ?> Comments</h2>
		<img/>
		@foreach($project->comments as $comment)
			<div><img src="/{{$comment->profile->image->getSize('thumb')->getPathname()}}"/></div>
			<div>{{$comment->profile->user->firstname}} {{$comment->profile->user->lastname}}</div>
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