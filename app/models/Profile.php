<?php

class Profile extends BaseModel {

	protected $table = 'profile';

	public function projects()
	{
		return $this->belongsToMany('Project','profile_project','profile_id','project_id');
	}

	public function user()
	{
		return $this->hasOne('User','id');
	}

	public function image()
	{
		return $this->belongsTo('Image');
	}

	public function imageProfile()
	{
		return Account::find($this->image_id);
	}

	public function getImagePathname($size = 'thumb')
	{
		// If an image was linked.
		if ($image = $this->image)
		{
			return $image->getSize($size)->getPathname();
		}

		// Return placeholder by default.
		return '/images/person.png';
	}

}