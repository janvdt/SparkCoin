<?php

class Size extends BaseModel {

	/**
	 * The attributes that can't be mass assigned.
	 *
	 * @var array
	 */
	protected $guarded = array('id');

	/**
	 * Turn off timestamps.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Returns the pathname for this image size.
	 *
	 * @return string
	 */
	public function getPathname()
	{
		return $this->path . '/' . $this->name;
	}

}