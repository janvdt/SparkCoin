<?php

class Fund extends BaseModel {

	protected $table = 'funds';

	public function projects()
	{
		return $this->belongsToMany('Project','project_funds','profile_id','project_id');
	}

	
}