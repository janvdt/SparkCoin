@extends('layout')

@include('instance.header')

@section('content')


<h2>Edit gallery</h2>

<form class="form-horizontal" name="editgallery" method="POST" action="{{ URL::action('GalleryController@update', array($gallery->id)) }}" onsubmit="return validate(this)">
	<input type="hidden" name="_method" value="PUT">
	<div class="row">
		<div class="span9">
			<div class="control-group">
				<label class="control-label">Gallery name</label>
				<div class="controls">
					<input type="text" placeholder="Gallery Name" name="title" value="{{ Input::old('title', $gallery->title) }}"></input>
					<span class="help-inline">{{ $errors->first('title') }}</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span9">
			<a class="btn btn-primary btn-create" href="{{ URL::action('GalleryController@uploadImage',array($gallery->id))}}">Add image</a>
		</div>
	</div>
	@if (count($gallery->images))
	<ul class="nav nav-pills"  id="sortablegallery">
		@foreach($gallery->images as $image)
		<li class="ui-state-default">
			<div class="span1 thumbnail-gallery" data-gallery-id="{{ $gallery->id }}" data-image-id="{{ $image->id }}">
				<a class="fancybox" rel="group" href="/{{ $image->getSize('medium')->getPathname() }}" title="{{$image->title}}">
				<img class="avatar img-polaroid" src="/{{ $image->getSize('thumb')->getPathname() }}" alt="">
			</a>
				<label class="pull-left">
					{{Form::checkbox('remove[]', $image->id)}}
				</label>
				<a class="pull-right" href="#delete-gallery-image-{{ $image->id }}" data-toggle="modal">remove</a>
			</div>
		</li>
		@endforeach
	</ul>
	@endif
	<div class="row">
		<div class="span9"> 
			<div class="form-actions">
				<a href="{{ URL::action('GalleryController@index')}}" class="btn">Cancel</a>
				<button type="submit" class="btn btn-primary">Save changes</button>
				<a href="#delete-gallery-{{ $gallery->id }}" data-toggle="modal" class="btn btn-danger">Delete gallery</a>
				<a id="buttonremove" class="btn btn-danger pull-right" href="#delete-selected" data-toggle="modal">Remove selected</a>
			</div>
		</div>
	</div>
</form>

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

<div class="modal hide fade" id="delete-selected">
	<form class="form-horizontal" method="POST" action="{{ URL::action('GalleryController@destroySelected') }}?gallery={{$gallery->id}}">
		<div class="modal-header">
			<input type="hidden"  id="removeimg" name="removeimg">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Delete selected images</h3>
		</div>
		<div class="modal-body">
			<p>Are you sure you want to delete the selected images from this gallery?</p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-danger" type="submit" value="Delete">
		</div>
	</form>
</div>


@foreach($gallery->images as $image)
<div class="modal hide fade" id="delete-gallery-image-{{ $image->id }}">
	<form class="form-horizontal" method="POST" action="{{ URL::action('GalleryController@destroyImage', array($image->id)) }}?gallery={{$gallery->id}}">
		<input type="hidden" name="_method" value="DELETE">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Delete picture</h3>
		</div>
		
		<div class="modal-body">
			<p>Are you sure you want to delete this picture from this gallery?</p>
		</div>
		
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Cancel</button>
			<input class="btn btn-danger" type="submit" value="Delete picture">
		</div>
	</form>
</div>
@endforeach
  
@stop

@section('scripts')

$( "#sortablegallery" ).sortable({
	handle:'img',
	items: 'li',
	listType:'ul',
	maxLevels:'1',
	toleranceElement: 'img',
	start:function(event, ui)
	{
		list = $('ul.sortable').nestedSortable('toArray');
		old_position = ui.item.index();
		
	},
	update:function(event, ui){
		var gallery_id = ui.item.find('> div').attr('data-gallery-id');
		var image_id = ui.item.find('> div').attr('data-image-id');
		list = $('ul.sortable').nestedSortable('toArray');
		index = ui.item.index();
		console.log(index);
		console.log(gallery_id);
		console.log(image_id);
		console.log(old_position);


		$.post('/gallery/ordergallery/' + gallery_id, { index : index, old_position : old_position, image_id : image_id },
		function(data)
		{
				console.log(data);	
		});
	}
	
});

@stop

@section('scriptsremove')

	function Populate(){
    vals = $('input[type="checkbox"]:checked').map(function() {
        return this.value;
    }).get().join(',');
    console.log(vals);
    $('#removeimg').val(vals);
	}

	$('input[type="checkbox"]').on('change', function() {
    Populate()
    $('#buttonremove').show();

    if(!$('#removeimg').val()){
	$('#buttonremove').hide();
	}
	}).change();

	

@stop