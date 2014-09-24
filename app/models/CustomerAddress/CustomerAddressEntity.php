<?php
namespace CustomerAddress;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerAddressEntity extends \Eloquent{

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
			$customer = new \CustomerAddress\CustomerAddress;
		}else{
			//update
			$customer = \CustomerAddress\CustomerAddress::find($id);
		}

		$customer->customer_id 		= \Input::get('customer_id', \Auth::id());
		$customer->address_line_1 	= \Input::get('address_line_1','');
		$customer->address_line_2 	= \Input::get('address_line_2','');
		$customer->town 			= \Input::get('town','');
		$customer->county 			= \Input::get('county','');
		$customer->postcode 		= \Input::get('postcode','');
		$customer->type 			= \Input::get('type','');

		$customer->save();
		return $customer;
	}
}
