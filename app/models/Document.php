<?php

class Document extends BaseModel {

	/**
	 * Returns the file model this document is linked to.
	 *
	 * @return FileModel
	 */
	public function file()
	{
		return $this->morphOne('FileModel', 'imageable');
	}

	/**
	 * Returns the pathname for this image size.
	 *
	 * @return string
	 */
	public function getPathname()
	{
		return $this->path . '/' . $this->name;
	}

	public function projects()
	{
		return $this->belongsToMany('Project');
	}

	
}