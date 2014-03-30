<?php

class GalleryController extends BaseController {

	 /**
     * Instantiate a new GalleryController instance.
     */
	public function __construct()
	{
		//permission filter for maanaging galleries.
		$this->beforeFilter('hasPermission:manage_galleries');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get app isntance.
		$galleries = Gallery::where('created_by', Auth::user()->id)->get();

		return View::make('gallery.index')
			->with('galleries',$galleries);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Get images for initial image select.
		$images = Image::where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();

		return View::make('gallery.create')
			->with('images',$images);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(
		Input::all(),
		array(
				'title' => 'required',
				'image_id'     => 'integer', 
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$gallery = new Gallery;
		$gallery->title = Input::get('title');
		$gallery->created_by = Auth::user()->id;

		$image = Input::get('image_id');

		$gallery->save();
		$gallery->images()->attach($gallery->id,array('image_id' => $image));

		return Redirect::action('GalleryController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$gallery = Gallery::find($id);

		return View::make('gallery.show')
			->with('gallery', $gallery);;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$gallery = Gallery::find($id);
					
		return View::make('gallery.edit')
			->with('gallery',$gallery);
	}

	/**
	 * Show the form for uploading image.
	 *
	 * @return Response
	 */
	public function uploadImage($id)
	{
		$gallery = Gallery::find($id);

		// Get first 10 iumages.
		$images = Image::where('created_by',Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();

		return View::make('gallery.upload')
			->with('images',$images)
			->with('gallery',$gallery);
			
	}

	/**
	 * Store the uploaded image.
	 *
	 * @return Response
	 */
	public function storeImage()
	{
		$validator = Validator::make(
		Input::all(),
		array(
				'image_id' => 'required', 
			)
		);
		
		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$inputimage = Input::get('image_id') ? Input::get('image_id'): 0;

		$image = Image::find($inputimage);

		$gallery = Gallery::find(Input::get('gallery_id'));

		//Update position of the images
		DB::table('gallery_image')
			->where('gallery_id', $gallery->id)
			->where('position_id', '>=', 0)
			->update(array('position_id' => DB::raw('position_id + 1')));

		$gallery->images()->attach($gallery->id,array('image_id' => $inputimage));
	
		return Redirect::action('GalleryController@edit', array($gallery->id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'title' => 'required',
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
					->withInput()
					->withErrors($validator);
		}

		$gallery = Gallery::find($id);
		$gallery->title = Input::get('title');
		$gallery->save();

		return Redirect::action('GalleryController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$gallery = Gallery::find($id);

		//if gallery is used in a block.
		if (count($gallery->blocks)) {
				return Redirect::back()->with('item_cant_be_deleted', true);
			}

		DB::table('gallery_image')
			->where('gallery_id',$gallery->id)
			->delete();

		$delete_gallery = Gallery::find($id);
		$delete_gallery->delete();

		return Redirect::action('GalleryController@index');
	}

	/**
	 * Remove the selected images from gallery.
	 *
	 * @return Response
	 */
	public function destroySelected()
	{
		$gallery = Gallery::find(Input::get('gallery'));
		$images = explode(',', Input::get('removeimg'));

		//remove all images that are selected.
		foreach ($images as $image){

			$gallery = Gallery::find(Input::get('gallery'));

			$galleries = DB::table('gallery_image')
				->where('gallery_id',$gallery->id);

			$galleries->where('image_id',$image);

			$tags = DB::table('image_tag')
				->where('image_id', $image);

			$galleries->delete();

			$tags->delete();
		}
  		return Redirect::action('GalleryController@edit',array($gallery->id));
	}

	/**
	 * Remove the specified image from storage.
	 *
	 * @return Response
	 */
	public function destroyImage($id)
	{
		$image = Image::find($id);

		//remove image from gallery.
		$gallery = Gallery::find(Input::get('gallery'));

		$galleries = DB::table('gallery_image')
			->where('gallery_id',$gallery->id);

		$galleries->where('image_id',$image->id);

		$tags = DB::table('image_tag')
			->where('image_id', $image->id);

		$galleries->delete();

		$tags->delete();
		
		return Redirect::action('GalleryController@edit',array($gallery->id));
	}

	/**
	 * update position gallery images
	 *
	 * @return Response
	 */
	public function orderGallery($id)
	{
		$gallery = Gallery::find($id);
		$new_position = Input::get('index');
		$old_position = Input::get('old_position');
		$image_id = Input::get('image_id');

		//Old postion is bigger then new position, increment position_id.
		if($old_position > $new_position)
		{
		DB::table('gallery_image')
			->where('gallery_id',$gallery->id)
			->where('position_id', '<', $old_position)
			->increment('position_id');
		}
		//Old postion is smaller then new position, increment position_id.
		else
		{
			DB::table('gallery_image')
			->where('gallery_id',$gallery->id)
			->where('position_id', '>=', $old_position)
			->decrement('position_id');
		}

		DB::table('gallery_image')
			->where('gallery_id',$gallery->id)
			->where('image_id', $image_id)
			->update(array('position_id' => $new_position));
	}
}