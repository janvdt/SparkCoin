<?php

class Image extends BaseModel {

	/**
	 * Returns the file model this image is linked to.
	 *
	 * @return FileModel
	 */
	public function file()
	{
		return $this->morphOne('FileModel', 'imageable');
	}

	/**
	 * Returns the image size models.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function sizes()
	{
		return $this->hasMany('Size');
	}

	/**
	 * Returns an image size object for the specified type.
	 *
	 * @param string $type
	 *
	 * @return Size
	 */
	public function getSize($type)
	{
		return Size::where('image_id', $this->id)->where('type', $type)->first();
	}
}