<?php
namespace User;
/**
 * main model for User
 * */
use \Illuminate\Auth\UserTrait;
use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableTrait;
use \Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

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

	/**
	 * Query scope to get confirm_code column
	 * @param 	$query	laravel default
	 * @param	$confirm_code	int		use to check confirm code to activate it
	 * @return 	query
	 * */
	public function scopeConfirmCode($query, $confirm_code){
		return $query->where('confirm_code', '=' , $confirm_code);
	}

	public function userToGroup(){
		return $this->hasMany('\UserToGroup\UserToGroup','user_id');
	}
}
