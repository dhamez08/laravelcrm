<?php
namespace CustomerNotes;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerNotesEntity extends \Eloquent{

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
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \CustomerNotes\CustomerNotes;
		}else{
			//update
			$obj = \CustomerNotes\CustomerNotes::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}else{
			return false;
		}
	}

	public function getNotes($customerId, $addedBy){
		$notes = \CustomerNotes\CustomerNotes::customerId($customerId)
		->addedBy($addedBy)
		->with('user')
		->with('customer')
		->orderBy('created_at','desc');
		return $notes;
	}
}
