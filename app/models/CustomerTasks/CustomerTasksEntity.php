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

	public function jsonTaskInCalendar($start_date, $end_date, $otherFilters = array()){
		$task = array();

		//$belongsTo = \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$belongsTo = \Auth::id();
		$belongsToArray = isset($otherFilters['user']) ? explode(',', $otherFilters['user']) : array($belongsTo);
		//$tasks	= \CustomerTasks\CustomerTasks::belongsToUser($belongsTo)->status(1)
		$tasks	= \CustomerTasks\CustomerTasks::belongsToUserIn($belongsToArray)->status(1)
		->startDate($start_date)
		->endDate($end_date)
		->with('label')
		->with('client');

		// Filters
		if(!empty($otherFilters['action']))	$tasks->taskSetting($otherFilters['action']);
		if(!empty($otherFilters['client']))	$tasks->customerID($otherFilters['client']);

		if( $tasks ){
			foreach($tasks->get() as $row){
				$parseEndTime = \Carbon\Carbon::parse($row->end_time);
				if( $parseEndTime->hour == '00' && $parseEndTime->minute == '00' ){
					$endhr = $parseEndTime->toDateString() . ' 23:00:00';
				}else{
					$endhr = $row->end_time;
				}
				$type = '';
				$customer_name = '';
				if( $row->client ){
					if( $row->client->type == 2 ){
						$customer_name = $row->client->company_name;
					}else{
						$customer_name = $row->client->title . ' ' .$row->client->first_name . ' ' . $row->client->last_name;
					}
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
					 'customer_name' => $customer_name,
					 'allDay' => false,
					 'belongsTo' => $row->belongs_to,
					 'customerId' => $row->customer_id,
				);
			}
		}
		echo json_encode($task);
	}

	public function getTaskUser($customerId = null, $belongsToUser = null, $otherFilters = array()){
		if( is_null($belongsToUser) ){
			$belongsToUser = \Auth::id();
		}
		if( !is_null($customerId) ){
			$tasks	= \CustomerTasks\CustomerTasks::status(1)
			//->belongsToUser($belongsToUser)
			->customerID($customerId)
			->with('label')
			->with('client')
			->orderBy('created_at','desc');
		}else{
			$tasks	= \CustomerTasks\CustomerTasks::status(1)
			//->belongsToUser($belongsToUser)
			->with('label')
			->with('client')
			->orderBy('created_at','desc');
		}

		// Filters
		if(!empty($otherFilters['action']))
			$tasks->whereIn('task_setting', array($otherFilters['action']));
		if(!empty($otherFilters['client']))
			$tasks->whereIn('customer_id', array($otherFilters['client']));
		if(!empty($otherFilters['user'])) {
			$userGroupId = \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
			$subUsers = \User\UserEntity::get_instance()->getSubscribeUsersList($userGroupId)->get();

			if(isset($otherFilters['user']) && $otherFilters['user'] == 'all') {
				$allList = array();
				$allList[] = \Auth::id();
				foreach ($subUsers as $su) {
					$allList[] = $su->user_id;
				}
				$otherFilters['user'] = implode(',', $allList);
			}
			$tasks->belongsToUserIn(explode(',', $otherFilters['user']));			
		} else {
			$tasks->belongsToUser($belongsToUser);
		}

		$arrayData = array();
		$due_all = 0;
		$due_today = 0;
		$due_future = 0;
		$due_seven_day = 0;

		$arrayData['due'] = (object)array(
			'all'=>$due_all,
			'today'=>$due_today,
			'future'=>$due_future,
			'seven'=>$due_seven_day
		);

		$arrayData['total'] = 0;
		$arrayData['data'] = array();
		$arrayData['tasks'] = array(
			'overdue'	=> array(),
			'today'		=> array(),
			'future'	=> array(),
			'seven'		=> array()
		);

		if( $tasks->count() > 0 ){
			$data = json_decode(json_encode($tasks->get()->toArray()), FALSE);
			$arrayData['total'] = $tasks->count();
			foreach( (object)$data as $valTask){
				$task = new \CustomerTasks\TasksFormat;
				$task->bind($valTask);
				$arrayData['data'][] = $task;
				//echo $valTask->name.'-'.\Carbon\Carbon::parse($valTask->date)->diffInDays().'<br>';
				if( \Carbon\Carbon::parse($valTask->date)->format('Y-m-d') == date('Y-m-d') ){
					$due_today += 1;
					//$due_all += 1;
					$arrayData['tasks']['today'][] = $task;
				}

				if( $valTask->date < \Carbon\Carbon::now()){
					$due_all += 1;
					$arrayData['tasks']['overdue'][] = $task;
				}

				if( \Carbon\Carbon::parse($valTask->date)->diffInDays() > 14
					&& $valTask->date > \Carbon\Carbon::now()
				){
					$due_future += 1;
					$arrayData['tasks']['future'][] = $task;
				}
				if( \Carbon\Carbon::parse($valTask->date)->diffInDays() >= 1
					&& \Carbon\Carbon::parse($valTask->date)->diffInDays() <= 14
					&& $valTask->date > \Carbon\Carbon::now()
				){
					$due_seven_day += 1;
					$arrayData['tasks']['seven'][] = $task;
				}

			}
			$arrayData['due'] = (object)array(
				'all'=>$due_all,
				'today'=>$due_today,
				'future'=>$due_future,
				'seven'=>$due_seven_day
			);

		}

		\Debugbar::info($arrayData);

		return $arrayData;
	}

    public function setReminded($id = null){
        if($id != null){
            $obj = \CustomerTasks\CustomerTasks::find($id);
            $obj->is_reminded = true;
            $obj->save();
            return $obj;
        }
    }

}
