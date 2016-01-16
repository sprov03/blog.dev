<?php

class Post extends Base
{
    protected $table = 'posts';

    public static $rules = array(

	    'title'      => 'required|min:10|max:50',
	    'body'       => 'required|max:10000'
	);

	public function setTitleAttribute($value)
	{
		$this->attributes['title'] = $value;
		// $this->attributes['slug'] = uniqid() . '-' . Str::slug($value);
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}
}