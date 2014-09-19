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
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
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
		$data['pageTitle'] 		= 'Task Action Label';
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'task-action-label';
		$data['labelAction'] 	= \TaskLabel\TaskLabelEntity::get_instance()->getMyActionLabel();
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.calendar.index', $data );
	}

	public function getAddActionLabel(){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Task Action Label';
		$data['pageSubTitle'] 	= 'Add Task Action Label';
		$data['contentClass'] 	= 'task-action-label';
		$data['icons'] 			= array_keys( \TaskLabel\TaskLabelEntity::get_instance()->getIcons() );
		$data['color_label'] 	= \TaskLabel\TaskLabelEntity::get_instance()->getColorLabel();
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.calendar.addTaskActionLabel', $data );
	}

	public function getActionLabelEdit($id){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Task Action Label';
		$data['pageSubTitle'] 	= 'Add Task Action Label';
		$data['contentClass'] 	= 'task-action-label';
		$data['task']			= \TaskLabel\TaskLabel::taskLabelID($id)->userID(\Auth::id())->first();
		$data['icons'] 			= array_keys( \TaskLabel\TaskLabelEntity::get_instance()->getIcons() );
		$data['color_label'] 	= \TaskLabel\TaskLabelEntity::get_instance()->getColorLabel();
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.calendar.editTaskActionLabel', $data );
	}

	public function putActionLabelUpdate($id, $userId){
		\Input::merge(array('user_id' => \Auth::id()));
		$rules = array(
			'action_name' => 'required|min:3',
			'icons' => 'required',
			'color' => 'required',
		);
		$messages = array(
			'action_name.required'=>'Action Name is required',
			'action_name.min'=>'Action Name must have more than 3 character',
			'icons.required'=>'Choose Icons',
			'color.min'=>'Choose Color',
		);
		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			\TaskLabel\TaskLabelEntity::get_instance()->createOrUpdate($id);
			\Session::flash('message', 'Successfully Updated Action Label');
			return \Redirect::action('Settings\TaskLabelController@getIndex');
		}else{
			\Input::flash();
			return \Redirect::to('settings/task-label/add-action-label')
			->withErrors($validator)
			->withInput();
		}
	}
	public function postAddActionLabel(){
		\Input::merge(array('user_id' => \Auth::id()));
		$rules = array(
			'action_name' => 'required|min:3',
			'icons' => 'required',
			'color' => 'required',
		);
		$messages = array(
			'action_name.required'=>'Action Name is required',
			'action_name.min'=>'Action Name must have more than 3 character',
			'icons.required'=>'Choose Icons',
			'color.min'=>'Choose Color',
		);
		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			\TaskLabel\TaskLabelEntity::get_instance()->createOrUpdate();
			\Session::flash('message', 'Successfully Added Action Label');
			return \Redirect::action('Settings\TaskLabelController@getIndex');
		}else{
			\Input::flash();
			return \Redirect::to('settings/task-label/add-action-label')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getDelete($id){
		$taskLabel  = \TaskLabel\TaskLabel::taskLabelID($id)->userID(\Auth::id());
		$taskLabel->forceDelete();

		\Session::flash('message', 'Successfully Deleted Action Label!');
		return \Redirect::action('Settings\TaskLabelController@getIndex');
	}

}
