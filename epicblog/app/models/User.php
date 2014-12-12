<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public function setPasswordAttribute($pass){

		$this->attributes['password'] = Hash::make($pass);

	}

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

	protected $fillable = array('email', 'username', 'password');

	static public $rules = array(
		'username' => 'required|alpha_dash|',
		'email' => 'required|email|unique:users,email',
		'emailLogin' => 'email',
		'password' => 'required|min:3'
	);


	public function posts()
    {
        return $this->hasMany('Post');
    }

    static public function tryLogin($input)
    {
    	$validation = Validator::make($input, array(
    		'email' => self::$rules['emailLogin'],
    		'password' => self::$rules['password'])
    	);

    	if (!$validation->fails() ) {
    		if ( Auth::attempt(array('email' => $input['email'], 'password' => $input['password']))) {
    	    	return null;
    		}
    		else {
    			$validation->errors()->add('wrongLogin', 'You have entered wrong username and password');
    		}
    	}

    	return $validation;
    }

    static public function tryStore($input)
    {
    	$validation = Validator::make($input, User::$rules);

    	if ($validation->fails()) {
    		return $validation;
    	}

    	User::create($input);
    	return null;
    }

}
