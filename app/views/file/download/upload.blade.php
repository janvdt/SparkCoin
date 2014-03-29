<p>
	<button id="upload-document-btn" class="btn" href="#upload-document" role="button" data-toggle="modal">Upload a document</button>
</p>

<span id="selected-download" class="help-block"></span>
<input type="hidden" id="selected-download-input" name="download_id">

@section('footer')
	
<div class="modal hide" id="upload-document">
	{{ Form::open(array('action' => 'FileController@store', 'files' => true, 'id' => 'upload-document-form', 'class' => 'form-horizontal')) }}
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Upload document</h3>
	</div>

	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="file">Select document</label>
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

@section('scriptsdocuments')


// Attach a click handler to a callback when the user selects an image
// in the file select modal.
$("a.select-document").on('click', selectDocument);


// Ajax file upload for the file upload modal.
$("#upload-document-form").ajaxForm({
	data: { require_document: 'true', 'ajax': 'true' },
	dataType: 'json',
	success: function(data) {
		// If the file id or title doesn't gets passed along,
		// something went wrong.
		if (!data.id || !data.title) {
			alert('Something went wrong with the file upload. Please only upload images and keep them below 2MB.');

			return false;
		}

		// If the upload succeeded, set the chosen file's id and title.
		setChosenDownload(data.id, data.title);

		// Update the document select table.
		$("#documents-table").html(data.table);

		// Hide the upload modal.
		$("#upload-document").modal('hide');
	}
});
@stop