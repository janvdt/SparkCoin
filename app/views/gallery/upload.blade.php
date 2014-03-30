@extends('layout')

@include('instance.header')

@section('content')

<h2>Add image to gallery</h2>
<form class="form-horizontal" method="POST" action="{{ URL::action('GalleryController@storeImage') }}" >
	<input type="hidden" name="gallery_id" value="{{$gallery->id}}">

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