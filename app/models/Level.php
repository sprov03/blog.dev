<?php

class Level extends Base
{
    protected $table = 'levels';

    public static $rules = array(

	    'game_id'      => 'required',
	    'level_name'       => 'required|max:50'
	);

	public function game()
	{
		return $this->belongsTo('Game');
	}

	public function calls()
	{
		return $this->hasMany('Call');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}