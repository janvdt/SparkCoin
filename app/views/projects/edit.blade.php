@extends('layout')

@include('instance.header')

@section('content')
<div>
	<h1>Create project</h1>
	<div>	
		<ul>
	        @foreach($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
	{{Form::model($project, array('route'=>array('projects.update',$project->id), 'method'=>'put', 'files' => true))}}
	<div>
		{{Form::label('name')}}
		{{Form::text('name')}}
	</div>
	<div>
		{{Form::label('description')}}
		{{Form::textarea('description')}}
	</div>
	<div>
		{{Form::label('address')}}
		{{Form::text('address')}}
	</div>	
	<div>
		{{Form::label('zipcode')}}
		{{Form::text('zipcode')}}
	</div>
	<div>
		{{Form::label('town')}}
		{{Form::text('town')}}
	</div>
	<div>
		{{Form::label('country')}}
		{{Form::text('country')}}
	</div>
	 <div class="image">
          {{ Form::hidden('image_id','',array('id' => 'selected-image-input')) }}
        <div class="control-group">
            {{ Form::label('image', 'Image') }}
            <div class="controls">
                @include('file.page.upload')
            </div>
        </div>
    </div>
 
	<div>
		{{Form::submit("Save changes")}}
		{{Form::reset("Reset")}}
	</div>
	{{Form::close()}}
</div>
@stop