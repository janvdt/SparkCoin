<?php

class Message extends BaseModel {

	public function profile()
	{
		return $this->belongsTo('Profile');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function notifications()
    {
        return $this->hasMany('Notification');
    }
}