/**
 * Dismisses selected image.
 *
 * @return void
 */
function dismissImage()
{
	// Empty image id input.
	$("#selected-image-input").attr('value', '');

	// Clear help text.
	$("#selected-image").html("");
}

function dismissDocument()
{
	// Empty image id input.
	$("#selected-document-input").attr('value', '');

	// Clear help text.
	$("#selected-document").html("");
}

function dismissDownload()
{
	// Empty image id input.
	$("#selected-download-input").attr('value', '');

	// Clear help text.
	$("#selected-download").html("");
}

function setChosenImage(id, title)
{
	// Set image id to hidden input.
	$("#selected-image-input").attr('value', id);

	// Set image title to help span.
	var dismissLink = " &nbsp;&nbsp;<a class='btn btn-round dismiss-image' href='#'><i class='icon-remove'></i></a>";
	var helpText = "Selected image: " + title + dismissLink;
	$("#selected-image").html(helpText);

	// Add dismiss event handler.
	$("a.dismiss-image").on('click', dismissImage);
}

/**
 * Gets the id and title from an image.
 *
 * @return void
 */
function selectImage()
{
	var id = $(this).attr('data-image-id');
	var title = $(this).attr('data-image-title');

	// Set the chosen id and title in the form.
	setChosenImage(id, title);
}

/**
 * Sets an image id and image title.
 *
 * @return void
 */
function setComment(user_id, body)
{
	
}

/**
 * Gets the id and title from an image.
 *
 * @return void
 */
function selectDocument()
{
	var id = $(this).attr('data-document-id');
	var title = $(this).attr('data-document-title');

	// Set the chosen id and title in the form.
	setChosenDocument(id, title);
}

function setChosenDocument(id, title)
{
	// Set image id to hidden input.
	$("#selected-document-input").attr('value', id);

	// Set image title to help span.
	var dismissLink = " &nbsp;&nbsp;<a class='btn btn-round dismiss-document' href='#'><i class='icon-remove'></i></a>";
	var helpText = "Selected document: " + title + dismissLink;
	$("#selected-document").html(helpText);

	// Add dismiss event handler.
	$("a.dismiss-document").on('click', dismissDocument);
}

function setChosenDownload(id, title)
{
	// Set image id to hidden input.
	$("#selected-download-input").attr('value', id);

	// Set image title to help span.
	var dismissLink = " &nbsp;&nbsp;<a class='btn btn-round dismiss-document' href='#'><i class='icon-remove'></i></a>";
	var helpText = "Selected download: " + title + dismissLink;
	$("#selected-download").html(helpText);

	// Add dismiss event handler.
	$("a.dismiss-download").on('click', dismissDownload);
}


$(document).ready(function(){

// Belgian date format datepicker.
if ($('input.datepicker-belgian')) {
	$('input.datepicker-belgian').datepicker({
		"dateFormat" : "dd/mm/yy"
	});
}

// Quickly jump to a folder snippet.
$('#select-goto-folder').change(function(){
	// Get the selected folder.
	var folder = $(this).val();

	// By default get the url to the root folder.
	var url = $('#form-goto-folder').attr('data-files-url');

	// If a folder other than the root folder was selected,
	// send the user to that folder.
	if (folder && folder != 0) {
		// Get the url from the action.
		url = $('#form-goto-folder').attr('action');

		// Append the folder id.
		url = url + '/' + folder;
	}

	// Redirect to url.
	window.location = url;
});

});