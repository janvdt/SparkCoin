@extends('layout')

@include('instance.header')

@section('content')

@include('profile.dashboard.header')

<div class="documentssplash">
	<h2>Document</h2>
	<a href="{{ URL::action('DocumentController@create') }}" class="btn btn-primary btn-create">Add document</a>
	

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Type</th>
				<th>Filename</th>
				<th>Date created</th>
				<th>Used in</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($files as $file)
			<tr>
				<td>{{$file->imageable->title}}</td>
				<td>{{$file->imageable->document_type}}</td>
				<td>{{$file->imageable->name}}</td>
				<td>{{$file->imageable->created_at}}</td>
				<td>@foreach($file->imageable->projects as $project)
					<a href="{{{ URL::action('ProjectController@show', array($project->id)) }}}">{{$project->name}}</a><br />
					@endforeach</td>
				<td>
				<a class="btn btn-warning" href="{{$file->imageable->path}}/{{$file->imageable->name}}">
				<i class="icon-download-alt icon-white"></i>
				</a>
				<a class="btn btn-danger" href="#delete-document-{{ $file->id }}" data-toggle="modal">
					<i class="icon-trash icon-white"></i>
				</a>
				<a class="btn btn-success" href="{{ URL::action('DocumentController@edit', array($file->imageable->id)) }}">
							<i class="icon-pencil icon-white"></i>
						</a>
				<td>{{Form::checkbox('remove[]', $file->id)}}</td>
				
				<div class="modal hide fade" id="myModal" data-backdrop="false">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h3>Delete</h3>
					</div>

					<div class="modal-body">
						<p>Are you sure you want to delete this document?</p>
					</div>

					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
						<a href="#" class="btn btn-danger">Delete</a>
					</div>
				</div>
				</td>
			</tr>

			<div class="modal hide fade" id="delete-selected">
				<form class="form-horizontal" method="POST" action="{{ URL::action('FileController@destroySelected') }}">
					<input type="hidden"  id="removedoc" name="removedoc">
					<div class="modal-header">
						<input type="hidden"  id="removeimg" name="removeimg">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3>Delete selected documents</h3>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete the selected documents?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal">Cancel</button>
						<input class="btn btn-danger" type="submit" value="Delete">
					</div>
				</form>
			</div>

			<div class="modal hide fade" id="delete-document-{{ $file->id }}" >
				<form class="form-horizontal" method="POST" action="{{ URL::action('FileController@destroy', array($file->id)) }}" >
					<input type="hidden" name="_method" value="DELETE">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3>Delete Document</h3>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this document?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal">Cancel</button>
						<input class="btn btn-danger" type="submit" value="Delete document">
					</div>
				</form>
			</div>
			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="span9">
			<div class="pagination pagination-centered">
				{{ $files->links() }}
			</div>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<div class="form-actions">
				<a id="buttonremove" href="#delete-selected" data-toggle="modal" class="btn btn-danger pull-right">Delete selected</a>
			</div>
		</div>
	</div>
</div>
</div>
@stop