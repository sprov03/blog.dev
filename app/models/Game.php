<?php

class Game extends Base
{
    protected $table = 'games';

    public static $rules = array(

	    'game'      => 'required|min:3|max:50'
	);

	public function levels()
	{
		return $this->hasMany('Level');
	}

	public function version()
	{
		return $this->belongsTo('Version');
	}
}