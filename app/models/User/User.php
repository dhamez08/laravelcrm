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

	public function permission(){
		return $this->hasMany('\UserPermission\UsersPermission', 'user_id');
	}

	public function userToGroup(){
		return $this->hasMany('\UserToGroup\UserToGroup');
	}

	public function userGroup(){
		return $this->hasOne('\UserGroup\UserGroup','manager_id','user_id');
	}

	public function group() {
		return $this->hasOne('\UserGroup\UserGroup','manager_id');
	}

	public function emailTemplate()
	{
		return $this->hasMany('\EmailTemplate\EmailTemplate', 'belongs_to', 'id');
	}

	public function emailSignature()
	{
		return $this->hasMany('\EmailSignature\EmailSignature', 'belongs_to', 'id');
	}

	/**
	 * Query scope to get confirm_code column
	 * @param 	$query	laravel default
	 * @param	$confirm_code	int		use to check confirm code to activate it
	 * @return 	query
	 * */
	public function scopeConfirmCode($query, $confirm_code){
		return $query->where('confirm_code', '=' , $confirm_code);
	}

	/**
	 * Query scope to get user ID column
	 * @param 	$query	laravel default
	 * @param	$userID	mix		user id
	 * @return 	query
	 * */
	public function scopeGetID($query, $userID){
		return $query->where('id', '=' , $userID);
	}

	public function tabs() {
		return $this->hasOne('\UserTab\UserTabEntity','user_id');
	}

	public function customtabs() {
		return $this->hasMany('\CustomFieldTab\CustomFieldTab','user_id','id')->whereNull('deleted_at');
	}
}
