<?php

class Version extends Base
{
    protected $table = 'versions';

    public static $rules = array(

	    'version'      => 'required|min:5|max:100'
	);

	public function games()
	{
		return $this->hasMany('Game');
	}
}