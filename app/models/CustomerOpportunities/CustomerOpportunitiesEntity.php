<?php
namespace CustomerOpportunities;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerOpportunitiesEntity extends \Eloquent{

	protected static $instance = null;

	protected $table = 'customer_opportunities';

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

	public function tags() {
		return $this->hasMany('CustomerOpportunitiesTags\CustomerOpportunitiesTagsEntity','opp_id');
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
		$obj->customer_id = \Input::get('customer_id',\Auth::id());
		$obj->belongs_to = \Input::get('belongs_to',0);
		$obj->belongs_user = \Input::get('belongs_user',0);
		$obj->milestone = \Input::get('milestone','');
		$obj->probability = \Input::get('probability','');
		$obj->value = \Input::get('expected_value','');
		$obj->value_calc = \Input::get('value_calc','');
		$obj->close_date = \Input::get('close_date','');
		$obj->name = \Input::get('opportunity_name','');
		$obj->text = \Input::get('opportunity_description','');
		$obj->status = \Input::get('status','');
		return $obj->save() ? $obj:0;
	}

	public function getListsByLoggedUser() {
		//$obj = new \CustomerOpportunities\CustomerOpportunities;
		return $this->with('tags')->where('belongs_to','=',\Auth::id())->get();
	}

}
