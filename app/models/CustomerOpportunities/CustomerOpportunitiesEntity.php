<?php
namespace CustomerOpportunities;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerOpportunitiesEntity extends \Eloquent{

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
			$obj = new \CustomerOpportunities\CustomerOpportunities;
		}else{
			//update
			$obj = \CustomerOpportunities\CustomerOpportunities::find($id);
		}
		$obj->customer_id = \Input('customer_id',\Auth::id());
		$obj->belongs_to = \Input('belongs_to',0);
		$obj->belongs_user = \Input('belongs_user',0);
		$obj->milestone = \Input('milestone','');
		$obj->probability = \Input('probability','');
		$obj->value = \Input('value','');
		$obj->value_calc = \Input('value_calc','');
		$obj->close_date = \Input('close_date','');
		$obj->name = \Input('name','');
		$obj->text = \Input('text','');
		$obj->status = \Input('status','');
		$obj->save();
		return $obj;
	}

}
