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
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \CustomerTasks\CustomerTasks;
		}else{
			//update
			$obj = \CustomerTasks\CustomerTasks::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}

	public function getCustomerTasks($customerID){
		return \CustomerTasks\CustomerTasks::customerID($customerID);
	}

	public function jsonTaskInCalendar($start_date, $end_date){
		$task = array();

		$belongsTo = \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$tasks	= \CustomerTasks\CustomerTasks::belongsToGroup($belongsTo)->status(1)
		->startDate($start_date)
		->endDate($end_date)
		->with('label')
		->with('client');

		foreach($tasks->get() as $row){
			$task[] = array(
				 'id' => $row->id,
				 'title' => $row->name,
				 'start' => $row->date,
				 'end' => $row->end_time,
				 'url' => "",
				 'color'=> $row->label->color,
				 'icon' => $row->label->icons,
				 'customer_id' =>$row->customer_id,
				 'customer_name' => ( $row->client->type == 2 )  ? $row->client->company_name : $row->client->title . ' ' .$row->client->first_name . ' ' . $row->client->last_name,
				 'allDay' => false
			);
		}
		echo json_encode($task);
	}
}
