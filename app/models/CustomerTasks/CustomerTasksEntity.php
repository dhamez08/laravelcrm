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

		//$belongsTo = \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$belongsTo = \Auth::id();
		$tasks	= \CustomerTasks\CustomerTasks::belongsToUser($belongsTo)->status(1)
		->startDate($start_date)
		->endDate($end_date)
		->with('label')
		->with('client');

		foreach($tasks->get() as $row){
			$parseEndTime = \Carbon\Carbon::parse($row->end_time);
			if( $parseEndTime->hour == '00' && $parseEndTime->minute == '00' ){
				$endhr = $parseEndTime->toDateString() . ' 23:00:00';
			}else{
				$endhr = $row->end_time;
			}
			$task[] = array(
				 'id' => $row->id,
				 'title' => $row->name,
				 'start' => $row->date,
				 'end' => $endhr,
				 'url' => "",
				 'color'=> $row->label->color,
				 'icon' => $row->label->icons,
				 'customer_id' =>$row->customer_id,
				 'customer_name' => ( $row->client->type == 2 )  ? $row->client->company_name : $row->client->title . ' ' .$row->client->first_name . ' ' . $row->client->last_name,
				 'allDay' => false,
				 'belongsTo' => $row->belongs_to,
				 'customerId' => $row->customer_id,
			);
		}
		echo json_encode($task);
	}

	public function getTaskUser($customerId = null, $belongsToUser = null){
		if( is_null($belongsToUser) ){
			$belongsToUser = \Auth::id();
		}
		if( !is_null($customerId) ){
			$tasks	= \CustomerTasks\CustomerTasks::status(1)
			->belongsToUser($belongsToUser)
			->customerID($customerId)
			->with('label')
			->with('client')
			->orderBy('created_at','desc');
		}else{
			$tasks	= \CustomerTasks\CustomerTasks::status(1)
			->belongsToUser($belongsToUser)
			->with('label')
			->with('client')
			->orderBy('created_at','desc');
		}

		$arrayData = array();
		$due_all = 0;
		$due_today = 0;
		$due_future = 0;
		$due_seven_day = 0;

		if( $tasks->count() > 0 ){
			$data = json_decode(json_encode($tasks->get()->toArray()), FALSE);
			$arrayData['total'] = $tasks->count();
			foreach( (object)$data as $valTask){
				$task = new \CustomerTasks\TasksFormat;
				$task->bind($valTask);
				$arrayData['data'][] = $task;

				if( \Carbon\Carbon::parse($valTask->date)->diffInDays() == 0 ){
					$due_today += 1;
					$due_all += 1;
				}

				if( \Carbon\Carbon::parse($valTask->date)->diffInDays() > 1
					&& $valTask->date < \Carbon\Carbon::now()
				){
					$due_all += 1;
				}

				if( \Carbon\Carbon::parse($valTask->date)->diffInDays() > 14
					&& $valTask->date > \Carbon\Carbon::now()
				){
					$due_future += 1;
				}
				if( \Carbon\Carbon::parse($valTask->date)->diffInWeeks() == 1
					&& $valTask->date > \Carbon\Carbon::now()
				){
					$due_seven_day += 1;
				}

			}
			$arrayData['due'] = (object)array(
				'all'=>$due_all,
				'today'=>$due_today,
				'future'=>$due_future,
				'seven'=>$due_seven_day
			);
		}
		//var_dump($arrayData);exit();
		return $arrayData;
	}

}
