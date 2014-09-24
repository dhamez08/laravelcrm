<?php
namespace CustomerEmail;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerEmailEntity extends \Eloquent{

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
	public function createOrUpdate($id = null){
		if( is_null($id) ) {
			//create
			$email = new \CustomerEmail\CustomerEmail;
		}else{
			//update
			$email = \CustomerEmail\CustomerEmail::find($id);
		}

		$email->customer_id 	= \Input::get('customer_id',\Auth::id());
		$email->email 			= \Input::get('email','');
		$email->type 			= \Input::get('type','');

		$email->save();
		return $email;
	}

}
