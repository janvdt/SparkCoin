@extends('layout')

@section('content')

<h1>Step 2/2 </h1>

<h2>Biography</h2>
	<div class="">
		<form class="form-horizontal" method="POST" action="{{ URL::action('ProfileController@store') }}">
			<div class="">
				<label class=""><h5>Tell Something About yourself!</h5>  </label>
				<div class="">
					<textarea class="" type="text" size="100" name="description" placeholder="Do your thing!" value=""></textarea>
					<span class="">required</span>
					<span class="">{{ $errors->first('description') }}</span>
				</div>
			</div>

			<div class="image">
          		{{ Form::hidden('image_id','',array('id' => 'selected-image-input')) }}
        		<div class="">
            		{{ Form::label('image', 'Image') }}
           			 <div class="">
               			 @include('file.profile.upload')
            		</div>
        		</div>
    		</div>
			
					
			<div class="form-actions">
				<a href="" class="btn">Cancel</a>
				<button type="submit" class="btn btn-inverse">Save</button>
			</div>
		</form>
	</div>
</div>