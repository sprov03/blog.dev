<?php

class Comment extends Base
{
    protected $table = 'comments';

    public static $rules = array(

	    'user_id'	=> 'required',
	    'post_id'	=> 'required',
	    'comment'	=> 'required|min:1|max:1000'	
	);

	public function users()
	{
		return $this->belongsTo('User');
	}

	public function posts()
	{
		return $this->belongsTo('Post');
	}
}