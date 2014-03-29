@extends('instance.layout')

@section('instanceContent')

<div class="span9 content">
	<h2>Edit Image</h2>
	<form class="form-horizontal" method="POST" action="{{ URL::action('ImageController@update', array($image->id)) }}" >
	<input type="hidden" name="_method" value="PUT">
		<div class="control-group">
		<label class="control-label" for="inputTextarea">Images / Media</label>
			<div class="controls">
				<img class="avatar img-polaroid" src="/{{ $image->getSize('thumb')->getPathname() }}" alt="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Title</label>
			<div class="controls">
				<input class="input-xlarge" type="text" size="100" id="inputTitle" placeholder="Title" name="title" value="{{ Input::old('title', $image->title) }}">
				<span class="help-inline">{{ $errors->first('title') }}</span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Alt tag</label>
			<div class="controls">
				<input class="input-xlarge" type="text" size="100" id="inputTag" placeholder="Alt tag" name="alt" value="{{ Input::old('alt', $image->alt) }}">
				<span class="help-inline">{{ $errors->first('alt') }}</span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Tags</label>
			<div class="controls">
				<input style="width: 300px;" type="text" name="tagsselect" value="<?php echo($selectedtags) ?>" class="tagselect"/>
				<input type="hidden" type="text" name="tagsselect-hidden" value="<?php echo($selectedtags) ?>" class="tagselect-hidden"/>
			</div>
		</div>
  		
		<div class="form-actions">
			<a href="{{{ URL::action('MediaController@index') }}}" class="btn">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>	
</div>

@stop

@section('scripts')
	@parent

	$(".tagselect").select2({
		createSearchChoice:function(term, data) { if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {return {id:term, text:term};} },
		multiple: true,
		data: <?php print(json_encode(array_values($tagsdata))); ?>,
		initSelection : function (element, callback) {
    	   var data = [];
			$(element.val().split(",")).each(function () {
			data.push({id: this, text: this});
		});
			callback(data);
		}
	}).on("change", function(e) {
		var tags = JSON.stringify({val:e.val, added:e.added, removed:e.removed});
		console.log(tags);
		$('.tagselect-hidden').attr('value', tags);
	});
@stop