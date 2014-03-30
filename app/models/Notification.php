<?php

class Notification extends BaseModel {


	public function project()
    {
        return $this->belongsTo('Project');
    }

    public function message()
    {
        return $this->belongsTo('Message');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}