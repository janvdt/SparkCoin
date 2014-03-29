<?php

class Project extends BaseModel {

	protected $table = 'projects';

	public static $rules = array(
	   'name'=>'required',
	   'description'=>'required',
	   'address'=>'required',
	   'zipcode'=>'required'
	   );

	public function profile()
    {
    	return $this->belongsToMany('Profile','profile_projects','project_id','profile_id');
    }

	public function funds()
    {
    	return $this->belongsToMany('Fund','project_funds','profile_id','project_id');
    }


    public function image()
	{
		return $this->belongsTo('Image');
	}

	public function imageable()
	{
		return $this->morphTo();
	}



	public function comments()
    {
		return $this->hasMany('Comment');
	}

}