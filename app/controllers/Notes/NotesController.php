<?php
namespace Notes;
use Carbon\Carbon;
class NotesController extends \BaseController {

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

	protected $noteFolder;

	protected $prefixNoteFileName;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.page.index';
		$this->data_view['include'] 	= $this->data_view['view_path'] . '.notes';
		$this->modalClass 		= 'ajaxModal';
		$this->noteFolder 	 	= public_path() . '/documents';
		//'pdf|doc|docx|gif|jpg|png'
		$this->prefixNoteFileName = \Auth::id();
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

	public function getIndex($customerId, $belongsToUser){
		$dashboard_data 		= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 					= $this->data_view;
		$belongsTo 				= \Auth::id();
		//$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($customerId, $belongsToUser);
		if(!is_null($customerId)){
			$data['customerId'] = $customerId;
		}
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['include'] . '.index', $data )->render();
	}

	public function getAjaxCreateInput($customerId){
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$data['customerId'] 		= $customerId;
		$data['pageTitle'] 			= 'Add Note';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= '';
		$data['portlet_title']		= 'Note';
		$data['fa_icons']			= 'cog';
		$data 						= array_merge($data,$dashboard_data);

		return \View::make( $data['include'] . '.create', $data )->render();
	}

	public function postAjaxCreateNote($clientId){
		$arr = array(
			$clientId,
			\Input::file('notefile'),
			\Input::all()
		);
		var_dump($arr);
		//return \Response::json(array('result'=>false,'message'=>$arr));
		die();
	}

}
