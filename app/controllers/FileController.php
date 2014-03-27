<?php

use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

class FileController extends BaseController {


	/**
	 * Display a listing of files in the root folder.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Custom error message.
		$messages = array(
			'file.required' => 'The :attribute field is required.<br>Also make sure your image doesn\'t exceeds 2MB.',
		);

		// Validation rules.
		$rules = array('file' => 'required|max:2048');

		// If the file needs to be an image.
		if (Input::get('require_image')) {
			$rules['file'] = $rules['file'] . '|image';
		}

		// Validate the input.
		$validator = Validator::make(
			array('file' => Input::file('file')),
			$rules,
			$messages
		);

		// If the validation fails.
		if ($validator->fails()) {
			// If it was an ajax upload, send an error message in json format.
			if (Input::get('ajax')) {
				return Response::json(array('error' => 'true'));
			}

			// Else redirect back to the File Manager creation form.
			return Redirect::back()
				->withErrors($validator)
				->with('new_file_error', true);
		}

		// Get the uploaded file.
		$file = Input::file('file');

		// Set the upload path.
		$path = 'uploads/' . date('Y') . '/' . date('m');

		// Check if the file already exists and
		// optionally generate a new filename.
		$filename = $this->checkFilename($path, $file->getClientOriginalName());

		// Move file to upload folder.
		$file->move($path, $filename);

		// Refresh file object.
		$file = new SymfonyFile($path . '/' . $filename, $filename);

		// Prepare file to be saved into the database.
		$fileModel = new FileModel;

		// Determine if the file is an image.
		if (getimagesize($file->getPathname())) {
			// If it's an image, create an image.
			$ImageController = new ImageController;
			$image = $ImageController->store($file);

			// Set imageable id and type.
			$fileModel->imageable_id = $image->id;
			$fileModel->imageable_type = 'Image';
		}

		// Else, it's probably a document.
		else {
			// Create a document.
			$DocumentController = new DocumentController;
			$document = $DocumentController->store($file);

			// Set imageable id and type.
			$fileModel->imageable_id = $document->id;
			$fileModel->imageable_type = 'Document';

		}

		// Save the file to the database.
		$fileModel->save();

		// If it was an ajax call, pass along the filename and file id
		// as a json array.
		if (Input::get('ajax')) {
			// Refresh images table.
			$images = Image::orderBy('created_at', 'desc')->take(10)->get();

			$response = array(
				'id'    => $fileModel->imageable_id,
				'title' => $fileModel->imageable->title,
				'table' => View::make('file.image.table')
					->with('images', $images)
					->render(),
			);

			return Response::json($response);
		}

		// Redirect back to the folder.
		return Redirect::back()->with('file_created', true);
	}

	/**
	 * Checks if the file already exists in that location
	 * and optionally creates a new unique filename by
	 * appending a number.
	 *
	 * Source: http://css-tricks.com/snippets/php/check-if-file-exists-append-number-to-name/
	 *
	 * @param string $path
	 * @param string $filename
	 * @return string
	 */
	protected function checkFilename($path, $filename){
		if ($pos = strrpos($filename, '.')) {
			$name = substr($filename, 0, $pos);
			$ext = substr($filename, $pos);
		}

		else {
			$name = $filename;
		}

		$newpath = $path . '/' . $filename;
		$newname = $filename;
		$counter = 0;

		while (file_exists($newpath)) {
			$newname = $name . '_' . $counter . $ext;
			$newpath = $path.'/'.$newname;
			$counter++;
		}

		return $newname;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$file = FileModel::find($id);

		// Destroy the file depending on the imageable type.
		if ($file->imageable_type == 'Image') {
			// If there are still images linked to pages,
			// prevent this image from being deleted.
			if (count($file->imageable->blocks)) {
				return Redirect::back()->with('item_cant_be_deleted', true);
			}

			if (count($file->imageable->galleries)) {
				return Redirect::back()->with('item_cant_be_deleted', true);
			}

			$ImageController = new ImageController;
			$ImageController->destroySizes($file->imageable_id);
		}

		else {

			if (count($file->imageable->blocks)) {
				return Redirect::back()->with('item_cant_be_deleted', true);
			}

			File::delete($file->imageable->path . '/' . $file->imageable->name);
		}

		// Remove the file type from the database.
		$file->imageable->delete();

		// Remove the file from the database.
		$file->delete();

		// Redirect back to the folder.
		return Redirect::back()->with('file_deleted', true);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroySelected()
	{
		$documents = explode(',', Input::get('removedoc'));

		foreach($documents as $document)
		{
			$file = FileModel::find($document);


			if (count($file->imageable->blocks)) {
				return Redirect::back()->with('item_cant_be_deleted', true);
			}

			File::delete($file->imageable->path . '/' . $file->imageable->name);

			// Remove the file type from the database.
			$file->imageable->delete();

			// Remove the file from the database.
			$file->delete();

		}

		// Redirect back 
		return Redirect::back()->with('file_deleted', true);	
	}

}