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
		$data 						= array_merge($data,$dashboard_data);

		return \View::make( $data['view_path'] . '.calendar.index', $data );
	}

	public function getTaskCalendar(){
		$start =  \Carbon\Carbon::createFromTimeStamp(\Input::get('start'))->format('Y-m-d');
		$end =  \Carbon\Carbon::createFromTimeStamp(\Input::get('end'))->format('Y-m-d');
		return \CustomerTasks\CustomerTasksEntity::get_instance()->jsonTaskInCalendar($start, $end);
	}
		
}
