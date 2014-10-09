<?php
namespace CustomerTasks;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerTasksEntity extends \Eloquent{
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
			$obj = new \CustomerTasks\CustomerTasks;
		}else{
			//update
			$obj = \CustomerTasks\CustomerTasks::find($id);
		}
		$obj->customer_id 	 = \Input('customer_id',\Auth::id());
		$obj->belongs_to 	 = \Input('belongs_to','');
		$obj->task_setting 	 = \Input('task_setting','');
		$obj->name 			 = \Input('name','');
		$obj->date 			 = \Input('date','');
		$obj->end_time 		 = \Input('end_time','');
		$obj->completed_date = \Input('completed_date','');
		$obj->added_by 		 = \Input('added_by','');
		$obj->action 		 = \Input('action','');
		$obj->remind 		 = \Input('remind','');
		$obj->remind_mins 	 = \Input('remind_mins','');
		$obj->status 	     = \Input('status','');

		$obj->save();
		return $obj;
	}
}
