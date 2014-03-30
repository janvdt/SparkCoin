@extends('layout')

@include('instance.header')

@section('content')

<h2>Create gallery</h2>

<form class="form-horizontal" method="POST" action="{{ URL::action('GalleryController@store') }}" >
	<div class="control-group">
		<label class="control-label" for="inputPageTitle">Gallery title</label>
		<div class="controls">
			<input class="input-xxlarge" type="text" size="100" id="inputTitle" name="title" placeholder="Gallery title">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="image">Image</label>
		<div class="controls">
			@include('file.image.upload')
		</div>
	</div>

	<div class="form-actions">
		<a href="{{ URL::action('GalleryController@index') }}" class="btn">Cancel</a>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>	
@stop