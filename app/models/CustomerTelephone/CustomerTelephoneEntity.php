<?php
namespace CustomerTelephone;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerTelephoneEntity extends \Eloquent{

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
			$obj = new \CustomerTelephone\CustomerTelephone;
		}else{
			//update
			$obj = \CustomerTelephone\CustomerTelephone::find($id);
		}
		$obj->customer_id 	= \Input::get('customer_id',\Auth::id());

		if (substr(\Input::get('number'), 0, 2)=="07") {
			$mob_number = '44' . substr(\Input::get('number'), 1);
		} else {
			$mob_number = \Input::get('number','');
		}

		$obj->number 		= $mob_number;
		$obj->type 			= \Input::get('type','');
		$obj->save();
		return $obj;
	}
}
