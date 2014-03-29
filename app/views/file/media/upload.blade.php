<p>
	<button id="upload-image-btn" class="btn" href="#upload-image" role="button" data-toggle="modal">Upload an image</button>
</p>

<span id="selected-image" class="help-block"></span>
<input type="hidden" id="selected-image-input" name="image_id">

@section('footer')
<div class="modal hide" id="upload-image">
	{{ Form::open(array('action' => 'FileController@store', 'files' => true, 'id' => 'upload-image-form', 'class' => 'form-horizontal')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Upload image</h3>
	</div>

	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="file">Select image</label>
				<div class="controls">
					{{ Form::file('file', array('id' => 'file', 'class' => 'input-file uniform_on')) }}
					<span class="help-block">Max. 2MB</span>
				</div>
			</div>
		</fieldset>
	</div>

	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">Cancel</button>
		<input class="btn btn-primary" type="submit" value="Upload file">
	</div>
	</form>
</div>
@stop

@section('scripts')
@parent

// If the browser supports ajax file upload, show the upload button.
if (window.FormData) {
	formdata = new FormData();
	$("#upload-image-btn").css("display", "inline-block");
}

// Attach a click handler for when the user types in a search term
// in the file select search box.
$("#image-search").on('keyup', function(){
	var search = $(this).attr('value');

	$.post(
		'{{ URL::action('ImageController@index') }}',
		{ search: search },
		function(data) {
			$("#images-table").html(data);
			// Attach new click handlers.
			$(".select-image").on('click', selectImage);
		}
	);

	return false;
});

// Attach a click handler to a callback when the user selects an image
// in the file select modal.
$("a.select-image").on('click', selectImage);



// Ajax file upload for the file upload modal.
$("#upload-image-form").ajaxForm({
	data: { require_image: 'true', 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
		// If the file id or title doesn't gets passed along,
		// something went wrong.
		if (!data.id || !data.title) {
			alert('Something went wrong with the file upload. Please only upload images and keep them below 2MB.');

			return false;
		}

		// If the upload succeeded, set the chosen file's id and title.
		setChosenImage(data.id, data.title);

		// Update the image select table.
		$("#images-table").html(data.table);

		// Hide the upload modal.
		$("#upload-image").modal('hide');
	}
});


@stop