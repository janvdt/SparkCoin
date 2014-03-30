<?php

class DocumentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Add a pagination of 8 documents a page.
		$pagination = 8;

		//Get documents with imageable type document of a certain instance.
		$files = FileModel::where('created_by', Auth::user()->id)
			->where('imageable_type', 'Document');

		
		// Add pagination to images. 
		$files = $files->paginate(8);

		return View::make('databank.document.index')->with('files',$files);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('databank.document.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($file)
	{
		$document = new Document;

		$document->type = $file->getExtension();
		$document->title = $file->getBasename('.' . $file->getExtension());
		$document->name = $file->getFilename();
		$document->path = $file->getPath();
		$document->mime = $file->getMimeType();
		$document->size = filesize($file->getPath() . '/' . $file->getFilename());
		$document->created_by = Auth::user()->id;

		$document->save();

		return $document;
	}

	public function storeDocument()
	{
		$validator = Validator::make(
		Input::all(),
		array(
				'title'	=> 'required',
			)
		);
		
		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$inputdocument = Input::get('document_id') ? Input::get('document_id'): 0;
		$document = Document::find($inputdocument);

		// Changes title and alt in database
		DB::table('documents')
		->where('id',$inputdocument)
		->update(array('title' => Input::get('title'),'document_type' => Input::get('document_type'))
		);

		return Redirect::action('DocumentController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}