<?php
namespace CustomerOpportunitiesTags;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerOpportunitiesTagsEntity extends \Eloquent{

	protected static $instance = null;

	protected $table = 'customer_opportunities_tags';

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

	public function opportunity() {
		return $this->belongsTo('CustomerOpportunities\CustomerOpportunitiesEntity');
	}

	public function tag() {
		return $this->belongsTo('OpportunityTag\OpportunityTagEntity');
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
		$tag = $this->where('opp_id','=',\Input::get('opp_id'))
					->where('opp_tag','=',\Input::get('opp_tag'))->get();
		if(count($tag)==0) {
			if( is_null($id) ) {
				//create
				$obj = new \CustomerOpportunitiesTags\CustomerOpportunitiesTags;
			}else{
				//update
				$obj = \CustomerOpportunitiesTags\CustomerOpportunitiesTags::find($id);
			}
			$obj->opp_id = \Input::get('opp_id');
			$obj->opp_tag = \Input::get('opp_tag');
			$obj->save();
			return $obj;
		}
	}
}
