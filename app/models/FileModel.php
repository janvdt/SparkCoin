<?php

class FileModel extends BaseModel {

	/**
	 * The database table for this model.
	 *
	 * @var string
	 */
	protected $table = 'files';

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
	 * Set polymorphic relationship.
	 */
	public function imageable()
	{
		return $this->morphTo();
	}

	public function image()
	{
		return $this->belongsTo('Image');
	}

}