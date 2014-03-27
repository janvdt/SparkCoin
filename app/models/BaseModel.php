<?php

class BaseModel extends Eloquent {

	/**
	 * The attributes that can't be mass assigned.
	 *
	 * @var array
	 */
	protected $guarded = array('id');

	

}

