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
	{{Form::open(array('action'=>'ProjectController@store', 'method'=>'post', 'files' => true))}}
	<div>
		{{Form::label('name')}}
		{{Form::text('name')}}
	</div>
	<div>
		{{Form::label('description')}}
		{{Form::textarea('description')}}
	</div>
	<div>
		{{Form::select('category', array('Amusement' => 'Amusement',
										   'Art' => 'Art', 
										   'Design' => 'Design',
										   'Education' => 'Education', 
										   'Fashion' => 'Fashion',
										   'Food' => 'Food',  
										   'Publishing' => 'Publishing',
										   'Technology' => 'Technology',))}}
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
                @include('file.image.upload')
            </div>
        </div>
    </div>

    <div class="control-group">
		<label class="control-label" for="image">Add Documents</label>
		<div class="controls">
		{{ Form::select('source[]', $documentArray, '', array('class' => 'chzn-select', 'data-placeholder' => 'Choose source files', 'tabindex' => '4', 'multiple')) }}
		</div>
	</div>

	<div class="">
		<label class="" for="inputPageTitle">Choose gallery</label>
		<div class="">
			<select name="gallery">
				@foreach($galleries as $gallery)
					<option value='{{$gallery->id}}'>{{$gallery->title}}</option>
				@endforeach
			</select>
		</div>
	</div>


 
	<div>
		{{Form::submit("Publish project")}}
		{{Form::reset("Reset")}}
	</div>
	{{Form::close()}}
</div>


@stop

