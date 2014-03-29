<?php

class Project extends BaseModel {

	protected $table = 'profile';

	public function projects()
	{
		return $this->belongsToMany('Project','profile_project','profile_id','project_id');
	}

}