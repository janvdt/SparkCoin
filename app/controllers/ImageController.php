<?php

use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

class ImageController extends BaseController {

	/**
	 * The current image model.
	 *
	 * @var Image
	 */
	protected $image;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$images = new Image;

		// If a search was performed.
		if (Input::get('search')) {
			$images = $images->where('title', 'like', '%' . Input::get('search') . '%');
		}

		// Filter images.
		$images = $images->where('instance_id',Config::get('app.instance'))->orderBy('created_at', 'desc')->take(10)->get();

		// Return the response as a table view.
		return View::make('file.image.table')->with('images', $images);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Symfony\Component\HttpFoundation\File\File $file
	 * @return Image
	 */
	public function store($file)
	{
		$this->image = new Image;

		$this->image->type = $file->getExtension();
		$this->image->title = $file->getBasename('.' . $file->getExtension());
		$this->image->created_by = Auth::user()->id;
		$this->image->updated_by = Auth::user()->id;

		$this->image->save();

		// Save the original image size.
		$this->createSize($file);

		// Save the thumb size.
		$this->createSize($file, 'thumb', array('square' => 225));

		// Save the medium size.
		$this->createSize($file, 'medium', array('width' => '500', 'height' => '350'));

		return $this->image;
	}

	/**
	 * Creates a new image size object in the database.
	 *
	 * @return void
	 */
	protected function createSize($file, $type = 'original', array $modifications = array())
	{
		// Set pathname.
		$pathname = $file->getPath() . '/' . $file->getFilename();

		// If it's not the original image, copy the image to a separate
		// folder and set a new file object.
		if ($type !== 'original') {
			// New path for size type.
			$new_path = $file->getPath() . '/' . $type;

			// If the folder doesn't exists yet, create it.
			if (!File::exists($new_path)) {
				File::makeDirectory($new_path);
			}

			// New pathname.
			$new_pathname = $new_path . '/' . $file->getFilename();

			// Copy file to size type folder.
			File::copy($pathname, $new_pathname);

			// Set the new pathname.
			$pathname = $new_pathname;

			// Refresh file object.
			$file = new SymfonyFile($pathname);
		}

		// Set an image handler object.		
		$imageHandler = ImageHandler::make($pathname);

		// If the image needs to be modified.
		if ($modifications) {
			// If the image needs to be square.
			if (array_key_exists('square', $modifications)) {
				$imageHandler->grab($modifications['square']);
			}

			// If the image must be resized. 
			elseif (array_key_exists('width', $modifications) || array_key_exists('height', $modifications)) {
				$width = array_key_exists('width', $modifications) ? $modifications['width'] : null;
				$height = array_key_exists('height', $modifications) ? $modifications['height'] : null;
				$imageHandler->resize($width, $height, true, false);
			}

			// Save modified image.
			$imageHandler->save($pathname);

			// Refresh file object.
			$file = new SymfonyFile($pathname);
		}

		// Clear stat cache for previous file.
		clearstatcache();

		// Create an new image size object.
		$size = new Size;

		$size->image_id = $this->image->id;
		$size->type = $type;
		$size->name = $file->getFilename();
		$size->path = $file->getPath();
		$size->mime = $file->getMimeType();
		$size->size = filesize($pathname);
		$size->width = $imageHandler->width;
		$size->height = $imageHandler->height;

		// Save the image size to the database.
		$size->save();
	}

	/**
	 * Destroys all image sizes linked to a certain image.
	 *
	 * @param integer $id The Image id
	 *
	 * @return $void
	 */
	public function destroySizes($id)
	{
		$image = Image::find($id);

		if (count($image->sizes)) {
			// Delete each image size.
			foreach ($image->sizes as $size) {
				// Delete the actual file.
				File::delete($size->getPathname());

				// Delete the image size from the database.
				$size->delete();
			}
		}
	}

	/**
	 * Destroys image.
	 *
	 * @return $void
	 */
	public function destroy($id)
	{
		$image = Image::find($id);

		if (count($image->galleries)) {
				
				return Redirect::back()->with('item_cant_be_deleted', true);
			}

		if (count($image->blocks)) {
				
				return Redirect::back()->with('item_cant_be_deleted', true);
			}


		$delete_gallery = Image::find($id);
		$delete_gallery->delete();
		return Redirect::action('MediaController@index');
	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{	
		$image = Image::find($id);

		$tagsdata = Tag::where('instance_id', Config::get('app.instance'));

		$tagsdata = $tagsdata->whereExists(function($query){
				$query->select(DB::raw('*'))
					  ->from('image_tag')
                      ->whereRaw('image_tag.tag_id = tags.id');
			})
			->lists('title', 'id');

		array_walk($tagsdata, function (&$item, $key) {
		$item = array("id"=>$item,"text"=>$item);
		});

		$selectedtags =   implode(',', $image->getTagsArray());

		return View::make('file.image.edit')
			->with('tagsArray', Tag::lists('title', 'id'))
			->with('image',$image)
			->with('selectedtags',$selectedtags)
			->with('tagsdata',$tagsdata);
	}

	/**
	 * Update the specified image
	 *
	 * @return Response
	 */
	public function update($id)
	{	
		
		$validator = Validator::make(
			Input::all(),
			array(
				'title' => 'required',
				'alt'   => 'required',
			)
		);

		if ($validator->fails())
		{
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		// validate if the number of tags exceeds the allowed to be chosen
		if (count(Input::get('tags')) > 3) {
			return Redirect::back()->with_errors(array('Sorry, you can only pick 3 maximum tags'));
		}


		$image = Image::find($id);

		$image->title = Input::get('title');

		$image->alt = Input::get('alt');

		$image->save();

		$obj = json_decode(stripslashes(Input::get('tagsselect-hidden')));

		if($obj == NULL)
		{
			$tag = Tag::where('title', Input::get('tagsselect-hidden'))->first();

			DB::table('image_tag')
				->where('image_id',$image->id)
				->delete();
		}
		else
		{
			DB::table('image_tag')
					->where('image_id',$image->id)
					->delete();

			foreach($obj->val as $val){
					
					$tag = Tag::where('title',$val)->first();
	
					if($tag != NULL){
	
					DB::table('image_tag')
					->insert(array('image_id' => $image->id, 'tag_id' => $tag->id));
				}
				else
				{
					DB::table('tags')
					->insert(array('title' => $val, 'instance_id' => Config::get('app.instance')));
	
					$tag = Tag::where('title',$val)->first();
	
					DB::table('image_tag')
					->insert(array('image_id' => $image->id, 'tag_id' => $tag->id));
				}
			}
		}

		$tags = Tag::all();

		foreach ($tags as $tag)
		{
			$document_tags = DB::table('document_tag')->where('tag_id', $tag->id)->get();
			$image_tags = DB::table('image_tag')->where('tag_id', $tag->id)->get();

			if (! count($document_tags) && ! count($image_tags)) {
				$tag->delete();
			}
		}
		
		return Redirect::action('MediaController@index');
	}

}