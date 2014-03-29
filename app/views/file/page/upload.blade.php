<p>
	<button id="upload-image-btn" class="btn" href="#upload-image" role="button" data-toggle="modal">Upload an image</button>
	
</p>

<span id="selected-image" class="help-block"></span>
<input type="hidden" id="selected-image-input" name="imageid">

@section('file')
	@parent
	<!-- Modal file select -->

	<div class="modal fade" id="upload-image">
		{{ Form::open(array('action' => 'FileController@store', 'files' => true, 'id' => 'upload-image-form', 'class' => 'form-horizontal')) }}
		<div class="modal-dialog">
			<div class="modal-content">
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
</div>
</div>
@stop
