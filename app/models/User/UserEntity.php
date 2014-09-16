<?php
namespace User;
/**
 * A wrapper for the User Model
 * */

use \Illuminate\Auth\UserTrait;
use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableTrait;
use \Illuminate\Auth\Reminders\RemindableInterface;

class UserEntity extends \Eloquent implements UserInterface, RemindableInterface {

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

	protected $user_model;

	protected static $instance = null;

	public function __construct(){
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * This is use to create user or update
	 * this is full field, mainly use in register
	 *
	 * @param 	$id		int		default null		if there is id then update, else create
	 * @param	$active	int		default 2			#2 means not active
	 * 												#1 would be active
	 * @return db last insert id
	 * */
	public function createOrUpdate($id = null, $active = 2){
		if( is_null($id) ) {
			//create
			$user 					= new \User\User;
			$user->username			= \Input::get('username');
			$user->password			= \Hash::make( \Input::get('password') );
			$user->title 			= \Input::get('title');
			$user->first_name 		= \Input::get('first_name');
			$user->last_name 		= \Input::get('last_name');
			$user->company 			= \Input::get('company');
			$user->email 			= \Input::get('email');
			$user->sms 				= \Input::get('sms');
			$user->telephone 		= \Input::get('telephone');
			$user->address_line 	= \Input::get('address_line');
			$user->address_town 	= \Input::get('address_town');
			$user->address_county 	= \Input::get('address_county');
			$user->address_postcode = \Input::get('address_postcode');
			$user->confirm_code 	= \Input::get('confirm_code');
			$user->active 			= $active;
			$user->save();

			return $user;
		}else{
			//update
			$user 					= \User\User::find($id);
			$user->username			= \Input::get('username');
			$user->password			= \Hash::make( \Input::get('password') );
			$user->title 			= \Input::get('title');
			$user->first_name 		= \Input::get('first_name');
			$user->last_name 		= \Input::get('last_name');
			$user->company 			= \Input::get('company');
			$user->email 			= \Input::get('email');
			$user->sms 				= \Input::get('sms');
			$user->telephone 		= \Input::get('telephone');
			$user->address_line 	= \Input::get('address_line');
			$user->address_town 	= \Input::get('address_town');
			$user->address_county 	= \Input::get('address_county');
			$user->address_postcode = \Input::get('address_postcode');
			$user->active 			= \Input::get('active');
			$user->save();

			return $user;
		}
	}

	/**
	 * Use to activate user
	 * @param	$confirm_coed	int		use to confirm code
	 * @return object
	 * */
	public function activateUser($confirm_code){
		$confirm = \User\User::confirmCode($confirm_code);
		if( $confirm->count() > 0 ){
			$user_id 		= $confirm->pluck('id');
			$user 			= \User\User::find($user_id);
			$user->active 	= 1;
			$user->save();
			return $user;
		}
	}

	/**
	 * update user account
	 * limited fields only
	 * personal fields particularly
	 *
	 * @param	$userId		int		pass user id
	 * @return object
	 * */
	public function updateAccount($userId){
		$user 					= \User\User::find($userId);
		$user->title 			= \Input::get('title');
		$user->first_name 		= \Input::get('first_name');
		$user->last_name 		= \Input::get('last_name');
		$user->company 			= \Input::get('company');
		$user->email 			= \Input::get('email');
		$user->sms 				= \Input::get('sms');
		$user->telephone 		= \Input::get('telephone');
		$user->address_line 	= \Input::get('address_line');
		$user->address_town 	= \Input::get('address_town');
		$user->address_county 	= \Input::get('address_county');
		$user->address_postcode = \Input::get('address_postcode');
		$user->save();

		return $user;
	}

}
