<?php
namespace Task;
use Carbon\Carbon;
class TaskController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * hold the view essentials like
	 * - title
	 * - view path
	 * @return array | associative
	 * */
	protected $data_view;

	protected $modalClass;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->modalClass = 'createTask';
	}

	/**
	 * Return an instance of this class.
	 *
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

	public function getIndex(){
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Task';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= '';
		$data['portlet_title']		= 'Task';
		$data['fa_icons']			= 'cog';
		$belongsTo 					= \Auth::id();
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser(null, \Auth::id());
		$data['redirectURL']		= url('task');
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['tasks']);
		//echo \Auth::id();
		return \View::make( $data['view_path'] . '.tasks.index', $data );
	}

	public function displayButtonModalCreateTask(){
		$data['modalTarget'] = 'createNewTask';
		return $data;
	}

	public function getModalCallClass(){
		return $this->modalClass;
	}

	public function modalCreateTask($arrayOtherOption = array()){
		$data['pageTitle'] 		= 'Task';
		$data['pageSubTitle'] 	= '';
		$data['option'] 		= (object)$arrayOtherOption;
		$data['modalClass']		= $this->modalClass;
		$data['getTime']		= \Config::get('crm.task_hour');
		$data['getMin']			= \Config::get('crm.task_min');
		$data 					= array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.tasks.create', $data );
	}

	public function getAjaxModalCreateTask($arrayOtherOption = array()){
		$data['redirectURL'] 	= $arrayOtherOption['redirect'];

		if( !is_null($arrayOtherOption['clientid']) ){
			$data['currentClient'] = \Clients\Clients::find($arrayOtherOption['clientid']);
			if($data['currentClient']->type == 2){
				$data['clientName'] = $data['currentClient']->company_name;
			}else{
				$data['clientName'] = $data['currentClient']->first_name . ' ' . $data['currentClient']->last_name;
			}
		}

		if( \Input::has('start') || \Input::has('end') ){
			$start = \Carbon\Carbon::createFromTimeStamp(\Input::get('start'));
			$data['start'] = $start->day.'/'.$start->month.'/'.$start->year;
			$data['startHour'] = $start->hour;
			$data['startMinute'] = $start->minute;
		}


		$data['pageTitle'] 		= 'Create Task';
		$data['pageSubTitle'] 	= '';
		$data['option'] 		= (object)$arrayOtherOption;
		$data['modalClass']		= $this->modalClass;
		$data['getTime']		= \Config::get('crm.task_hour');
		$data['getMin']			= \Config::get('crm.task_min');
		$data['taskLabel']		= \TaskLabel\TaskLabelEntity::get_instance()->getAllTaskLabel()->lists('action_name','id');
		$data['remindMin']		= \Config::get('crm.task_remind');
		$data 					= array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.tasks.createInput', $data );
	}

	public function putAjaxUpdateTask($taskid){
		$rules = array(
			'name' => 'required|min:3',
			'getclient' => 'required',
			'task_date' => 'required',
		);
		$messages = array(
			'name.required'=>'Task Name is required',
			'getclient.required'=>'Link to client is required',
			'name.min'=>'Task Name must have more than 3 character',
			'task_date.required'=>'Task date is required',
			'task_date.date'=>'Date is invalid',
			'task_date.date_format'=>'Date format is invalid',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if($validator->passes()){
			$mysqlDateFormat = \Carbon\Carbon::createFromFormat('d/m/Y',\Input::get('task_date'));
			$start_hour = \Input::get('task_hour');
			$start_min 	= \Input::get('task_min');
			$end_hour 	= \Input::get('end_task_hour');
			$end_min 	= \Input::get('end_task_min');
			$startDate 	= $mysqlDateFormat->instance($mysqlDateFormat)->toDateString() . ' ' . $start_hour . ':' . $start_min . ':00';

			if( \Input::has('time_not_required') ){
				$endHr 	= $mysqlDateFormat->instance($mysqlDateFormat)->toDateString() . ' ' . '00:00';
			}else{
				if( $end_hour == '00' ){
					$end_hour = $start_hour;
				}
				$endHr 	= $mysqlDateFormat->instance($mysqlDateFormat)->toDateString() . ' ' . $end_hour . ':' . $end_min . ':00';
			}

			$remind_time = (\Input::get('remind_mins') == 0) ?  "":date('Y-m-d H:i:s', strtotime('- '.\Input::get('remind_mins').' minutes', strtotime($startDate)));

			$settingsLabelName = \TaskLabel\TaskLabel::find(\Input::get('task_setting'));
			$data = array(
				'customer_id' 	=> \Input::get('customer_id'),
				'added_by' 		=> \Auth::user()->username,
				'name' 			=> \Input::get('name'),
				'date' 			=> $startDate,
				'end_time' 		=> $endHr,
				'action' 		=> $settingsLabelName->action_name,
				'task_setting' 	=> \Input::get('task_setting'),
				'status' 		=> '1',
				'remind' 		=> $remind_time,
				'remind_mins' 	=> \Input::get('remind_mins'),
				//'belongs_to' 	=> \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id
				'belongs_to'	=> \Auth::id()
			);
			$task = \CustomerTasks\CustomerTasksEntity::get_instance()->createOrUpdate($data, $taskid);

			\Session::flash('message', 'Successfully Updated Task' );
			if( \Input::has('redirect') ){
				return \Response::json(array('result'=>true,'redirect'=>\Input::get('redirect')));
			}else{
				return \Response::json(array('result'=>true,'redirect'=>\URL::action('Clients\ClientsController@getClientSummary',array('clientId'=>\Input::get('customer_id')))));
			}
			die();
		}else{
			$msg = $validator->messages()->all('<li class="list-group-item list-group-item-danger">:message</li>');
			return \Response::json(array('result'=>false,'message'=>$msg));
			die();
		}
	}
	public function postAjaxCreateTask(){
		$rules = array(
			'task_name' => 'required|min:3',
			'getclient' => 'required',
			'task_date' => 'required',
		);
		$messages = array(
			'task_name.required'=>'Task Name is required',
			'getclient.required'=>'Link to client is required',
			'task_name.min'=>'Task Name must have more than 3 character',
			'task_date.required'=>'Task date is required',
			'task_date.date'=>'Date is invalid',
			'task_date.date_format'=>'Date format is invalid',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if($validator->passes()){
			$mysqlDateFormat = \Carbon\Carbon::createFromFormat('d/m/Y',\Input::get('task_date'));
			$start_hour = \Input::get('task_hour');
			$start_min 	= \Input::get('task_min');
			$end_hour 	= \Input::get('end_task_hour');
			$end_min 	= \Input::get('end_task_min');
			$startDate 	= $mysqlDateFormat->instance($mysqlDateFormat)->toDateString() . ' ' . $start_hour . ':' . $start_min . ':00';

			if( \Input::has('time_not_required') ){
				$endHr 		= $mysqlDateFormat->instance($mysqlDateFormat)->toDateString() . ' ' . '00:00';
			}else{
				if( $end_hour != '00' ){
					$end_hour = $start_hour;
				}
				$endHr 	= $mysqlDateFormat->instance($mysqlDateFormat)->toDateString() . ' ' . $end_hour . ':' . $end_min . ':00';
			}

			$remind_time = (\Input::get('remind_mins') == 0) ?  "":date('Y-m-d H:i:s', strtotime('- '.\Input::get('remind_mins').' minutes', strtotime($startDate)));

			$settingsLabelName = \TaskLabel\TaskLabel::find(\Input::get('task_setting'));
			$data = array(
				'customer_id' 	=> \Input::get('customer_id'),
				'added_by' 		=> \Auth::user()->username,
				'name' 			=> \Input::get('task_name'),
				'date' 			=> $startDate,
				'end_time' 		=> $endHr,
				'action' 		=> $settingsLabelName->action_name,
				'task_setting' 	=> \Input::get('task_setting'),
				'status' 		=> '1',
				'remind' 		=> $remind_time,
				'remind_mins' 	=> \Input::get('remind_mins'),
				'belongs_to' 	=> \Auth::id()
				//'belongs_to' 	=> \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id
			);
			$task = \CustomerTasks\CustomerTasksEntity::get_instance()->createOrUpdate($data);

			\Session::flash('message', 'Successfully Added Task' );
			if( \Input::has('redirect') ){
				return \Response::json(array('result'=>true,'redirect'=>\Input::get('redirect')));
			}else{
				return \Response::json(array('result'=>true,'redirect'=>\URL::action('Clients\ClientsController@getIndex')));
			}
			die();
		}else{
			$msg = $validator->messages()->all('<li class="list-group-item list-group-item-danger">:message</li>');
			return \Response::json(array('result'=>false,'message'=>$msg));
			die();
		}
	}

	public function getEditClientTask($taskId, $customerId, $redirect = null){
		if(!is_null($redirect)){
			$data['redirectURL'] 	= url($redirect);
			$data['redirect'] 		= $redirect;
		}else{
			$data['redirectURL'] 	= url('clients/client-summary/' . $customerId);

		}
		$data['from']			= 'client';
		$data['pageTitle'] 		= 'Update Task';
		$data['pageSubTitle'] 	= '';
		$data['tasks'] 			= \CustomerTasks\CustomerTasks::find($taskId);
		$data['modalClass']		= $this->modalClass;
		$data['getTime']		= \Config::get('crm.task_hour');
		$data['getMin']			= \Config::get('crm.task_min');
		$data['taskLabel']		= \TaskLabel\TaskLabelEntity::get_instance()->getAllTaskLabel()->lists('action_name','id');
		$data['remindMin']		= \Config::get('crm.task_remind');
		$data['theDate']		= \Carbon\Carbon::parse($data['tasks']->date);
		$data['endDate']		= \Carbon\Carbon::parse($data['tasks']->end_time);

		$linkTo					= \Clients\Clients::find($data['tasks']->customer_id);
		if($linkTo->type == 2){
			$data['client_linkTo'] = $linkTo->company_name;
		}else{
			$data['client_linkTo'] = $linkTo->first_name.' '.$linkTo->last_name;
		}
		$data 					= array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data['tasks']->name);exit();
		return \View::make( $data['view_path'] . '.tasks.editInput', $data );
	}

	public function getCompleteTask($taskid, $customerid){
		$updateTask = \CustomerTasks\CustomerTasks::taskID($taskid)->customerID($customerid);
		if($updateTask->count()){
			$name = $updateTask->pluck('name');
			$data = array(
				'status'=>0,
			);
			$updateTask->update($data);
			if(\Input::has('redirect')){
				\Session::flash('message', 'Successfully Completed Task - ' . $name);
				return \Redirect::to(\Input::get('redirect'));
			}else{
				\Session::flash('message', 'Successfully Completed Task - ' . $name);
				return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$customerid));
			}
		}
	}

	public function getCancelTask($taskid, $customerid){
		$Task = \CustomerTasks\CustomerTasks::taskID($taskid)->customerID($customerid);
		if($Task->count()){
			$name = $Task->pluck('name');
			$Task->delete();
			if(\Input::has('redirect')){
				\Session::flash('message', 'Successfully Deleted Task - ' . $name);
				return \Redirect::to(\Input::get('redirect'));
			}else{
				\Session::flash('message', 'Successfully Deleted Task - ' . $name);
				return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$customerid));
			}
		}
	}

	public function getWidgetDisplay($customerId, $belongsToUser){
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$belongsTo 					= \Auth::id();
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($customerId, $belongsToUser);
		if(!is_null($customerId)){
			$data['customerId'] = $customerId;
		}
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['tasks']);
		//exit();
		return \View::make( $data['view_path'] . '.tasks.partials.widget', $data )->render();
	}

}
