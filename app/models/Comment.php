<?php

class Comment extends BaseModel {

	protected $table = 'comments';

	public static $rules = array(
	   'body'=>'required'
	   );

	public function project()
    {
		return $this->belongsTo('Project');
    }
    
    public function profile()
    {
    	return $this->belongsTo('Profile');
    }
}