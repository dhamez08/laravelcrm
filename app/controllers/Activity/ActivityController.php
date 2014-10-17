<?php
namespace Activity;
use Carbon\Carbon;
class ActivityController extends \BaseController {

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
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.page.index';
		$this->data_view['include'] 	= $this->data_view['view_path'] . '.activity';
		$this->modalClass = 'ajaxModal';
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

	}

	public function getWidgetDisplay($customerId, $belongsToUser){
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$belongsTo 					= \Auth::id();
		//$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($customerId, $belongsToUser);
		if(!is_null($customerId)){
			$data['customerId'] = $customerId;
		}
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data);
		return \View::make( $data['view_path'] . '.activity.partials.widget', $data )->render();
	}

}
