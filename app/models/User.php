<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Base implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static $rules = array(

	    'first_name'      	=> 'required|min:1|max:100',
	    'last_name'       	=> 'required|min:1|max:100',
	    'user_name'			=> 'required|min:3|max:100',
	    'email'				=> 'required|min:3|max:150',
	    'password'			=> 'required|min:3|max:255',
	    'birthday'			=> 'date',
	    'phone_number'		=> 'min:3|max:30',
	    'zipcode'			=> 'min:3|max:30'
	);

	public function setUsernameAttribute($value)
	{
	    $this->attributes['user_name'] = strtolower($value);
	}

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public function levels()
	{
		return $this->hasMany('Level');
	}

}
