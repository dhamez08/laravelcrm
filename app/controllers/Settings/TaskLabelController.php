<?php
namespace Settings;
/**
 * Email settings controller
 *
 * */

class TaskLabelController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;
	//protected $userEntity;

	/**
	 * hold the view essentials like
	 * - title
	 * - view path
	 * @return array | associative
	 * */
	protected $data_view;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		$this->data_view = parent::setupThemes();
		//$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		//$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->userEntity = new \User\UserEntity;
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

	/**
	 * get themes
	 * @return	array
	 * */
	public function getSetupThemes(){
		return \Dashboard\DashboardController::get_instance()->getSetupThemes();
	}

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex() {
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Email Settings';
		$data['pageSubTitle'] 	= 'mga settings para sa email';
		$data['contentClass'] 	= '';
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.email.email', $data );
	}

}
