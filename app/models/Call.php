<?php

class Call extends Base
{
    protected $table = 'calls';

    public static $rules = array(

	    'level_id'      => 'required',
	    'function'      => 'required|min:3|max:50',
	    'x'				=> 'required',
	    'y'				=> 'required',
	    'width'			=> 'required',
	    'height'		=> 'required|min:2|max:50'
	);

	public function level()
	{
		return $this->belongsTo('Level');
	}
}
