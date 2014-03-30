<?php

class Gallery extends BaseModel {

	/**
	 * Returns images ordered by order_id.
	 *
	 * 
	 * @return $images
	 */
	public function images()
	{
		return $this->belongsToMany('Image')->orderBy('gallery_image.position_id', 'asc');
	}
	
	/**
	 * Returns the block models.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function project()
	{
		return $this->hasMany('Project');
	}

	/**
	 * Set polymorphic relationship.
	*/
	public function projects()
    {
        return $this->morphMany('Project', 'imageable');
    }

}