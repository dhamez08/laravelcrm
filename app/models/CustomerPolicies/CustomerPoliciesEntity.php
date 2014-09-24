<?php
namespace CustomerPolicies;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerPoliciesEntity extends \Eloquent{

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
			$obj = new \CustomerPolicies\CustomerPolicies;
		}else{
			//update
			$obj = \CustomerPolicies\CustomerPolicies::find($id);
		}
		$obj->customer_id = \Input('customer_id',\Auth::id());
		$obj->policy = \Input('policy','');
		$obj->start_date = \Input('start_date','');
		$obj->renewal_date = \Input('renewal_date','');
		$obj->insurer = \Input('insurer','');
		$obj->product = \Input('product','');
		$obj->indemnity = \Input('indemnity','');
		$obj->type = \Input('type','');
		$obj->term = \Input('term','');
		$obj->benefit = \Input('benefit','');
		$obj->premium = \Input('premium','');
		$obj->collected = \Input('collected','');
		$obj->file = \Input('file','');
		$obj->status = \Input('status','');
		$obj->save();
		return $obj;
	}

}
