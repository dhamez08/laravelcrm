<?php
/**
 * A wrapper for the User Model
 * */
namespace User;
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

	public function createOrUpdate($id = null){
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
			$user->active 			= 2;
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

	public function activateUser($confirm_code){
		return \User\User::confirmCode($confirm_code);
	}

}
