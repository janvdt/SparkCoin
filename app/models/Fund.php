<?php

class Fund extends BaseModel {

	protected $table = 'funds';

	public function projects()
	{
		return $this->belongsToMany('Project','funds_projects','profile_id','project_id');
	}

	
}