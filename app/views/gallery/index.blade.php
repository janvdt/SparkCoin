@extends('layout')

@include('instance.header')

@section('content')

<div class="Gallery">
	
		<h2>Galleries</h2>
</div>


<div class="row">
	<div class="span6">
		<a class="btn btn-primary btn-create" href="{{ URL::action('GalleryController@create') }}">Create gallery</a>
	</div>
</div>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Picture</th>
			<th>Title</th>
			<th>Used in</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($galleries as $gallery)
		<tr>
			@if (count($gallery->images))
			<td class="center"><img class="avatar img-polaroid" src="/{{ $gallery->images->first()->getSize('thumb')->getPathname() }}" alt=""></td>
			@else
			<td class="center"></td>
			@endif
			<td class="center">{{$gallery->title}}</td>
			<td class="center">
				@foreach($gallery->projects as $project)
				<a href="{{{ URL::action('ProjectController@show', array($project->id)) }}}">{{$project->name}}</a><br />
				@endforeach
			</td>
			<td>
				<a class="btn btn-primary" href="{{ URL::action('GalleryController@show',array($gallery->id)) }}">
					<i class="icon-eye-open icon-white"></i>
				</a>
				
				<a class="btn btn-warning" href="{{ URL::action('GalleryController@edit',array($gallery->id)) }}">
					<i class="icon-pencil icon-white"></i>
				</a>
				
				<a class="btn btn-danger" href="#delete-gallery-{{ $gallery->id }}" data-toggle="modal">
					<i class="icon-trash icon-white"></i>
				</a>
			</td>
			<div class="modal hide fade" id="delete-gallery-{{ $gallery->id }}">
				<form class="form-horizontal" method="POST" action="{{ URL::action('GalleryController@destroy', array($gallery->id)) }}">
					<input type="hidden" name="_method" value="DELETE">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3>Delete gallery</h3>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this gallery?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal">Cancel</button>
						<input class="btn btn-danger" type="submit" value="Delete gallery">
					</div>
				</form>
			</div>
		@endforeach
		</tr>
	</tbody>
</table>

@stop