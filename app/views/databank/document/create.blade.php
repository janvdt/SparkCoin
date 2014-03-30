@extends('layout')

@include('instance.header')

@section('content')

@include('profile.dashboard.header')

<h2>Add document</h2>
<form class="form-horizontal" method="POST" action="{{ URL::action('DocumentController@storeDocument') }}" >
	
	<div class="">
		<label class="">Title</label>
		<div class="">
			<input class="input-xlarge" type="text" size="100" id="inputTitle" placeholder="Title" name="title">
			<span class="help-inline">{{ $errors->first('title') }}</span>
		</div>
	</div>

	<div class="">
		<label class="" for="image">Document</label>
		<div class="">
			@include('file.document.upload')
		</div>
	</div>

	<div class="form-actions">
		<a href="{{ URL::action('DocumentController@index') }}" class="btn">Cancel</a>
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>

@stop