<?php
namespace Calendar;
use Carbon\Carbon;
class CalendarController extends \BaseController {

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
		$data['pageTitle'] 			= 'Calendar';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= '';
		$data['portlet_title']		= 'Calendar';
		$data['fa_icons']			= 'calendar';
		$data['google_calendar']	= \User\UserEntity::get_instance()->getGoogleCalendarFeedURL();
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['view_path'] . '.calendar.index', $data );
	}

	public function getTaskCalendar(){
		return \CustomerTasks\CustomerTasksEntity::get_instance()->jsonTaskInCalendar(\Input::get('start'), \Input::get('end'));
	}

	public function getEditTask($taskId, $customerId, $redirect = null){
		$data['redirect'] 		= $redirect;
		$data['from'] 			= 'calendar';
		$data['redirectURL'] 	= url('calendar');
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
			\Session::flash('message', 'Successfully Completed Task - ' . $name);
			return \Redirect::action('Calendar\CalendarController@getIndex');
		}
	}


	public function postAjaxUpdateTask(){
		$data = array(
			'date' => \Input::get('new_task_date'),
			'end_time' => \Input::get('end_time'),
		);
		$taskid = \Input::get('task_id');
		\CustomerTasks\CustomerTasksEntity::get_instance()->createOrUpdate($data, $taskid);
	}
}
