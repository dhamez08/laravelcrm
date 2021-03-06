<?php
namespace CustomFieldTabs;

class CustomFieldTabsController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $customFieldTabEntity;
	protected $userEntity;
	protected $userTabEntity;
	protected $customFormEntity;
	protected $customFieldEntity;

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
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->customFieldTabEntity = new \CustomFieldTab\CustomFieldTabEntity;
		$this->userEntity = new \User\UserEntity;
		$this->userTabEntity = new \UserTab\UserTabEntity;
		$this->customFormEntity = new \CustomForm\CustomFormEntity;
		$this->customFieldEntity = new \CustomField\CustomFieldEntity;
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

	public function getIndex(){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Custom Field Settings';
		$data['tabActive'] 		= 'custom-tabs';
		$data['clientTabs']		= \Config::get('crm.settings.customFields.clientTabs');
		$data['clientTabRows']	= \Auth::user()->tabs; //$this->userEntity->find(\Auth::id())->tabs;
		$data['clientFiles']	= \Config::get('crm.settings.customFields.clientFiles');
		$data['clientFileRows']	= \Auth::user();	//$this->userEntity->find(\Auth::id())->getClientFiles();
		$data['customTabs']		= $this->customFieldTabEntity->getTabsByLoggedUser();
		$data['clientForms']	= $this->customFormEntity->getFormsByLoggedUser();
		$data['clientFields']	= $this->customFieldEntity->getFieldsByLoggedUser();
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'settings';
		$data['icons'] 			= array_keys( \TaskLabel\TaskLabelEntity::get_instance()->getIcons() );

		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data);exit();
		return \View::make( $data['view_path'] . '.settings.custom-fields.index', $data );
	}

	public function postAddTab() {
		$rules = array(
			'tab' => 'required|min:3',
			'icon' => 'required'
		);

		$messages = array(
			'tab.required' => 'Tab name is required.',
			'tab.min'=>'Tab name must have atleast 3 characters',

			'icon.required' => 'Icon is required.'
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {

			$this->customFieldTabEntity->saveTab(\Input::all());

			\Session::flash('message', 'The Tab was successfully created');
			return \Redirect::to('settings/custom-fields');
		}else{
			\Input::flash();
			return \Redirect::to('settings/custom-fields')
			->withErrors($validator)
			->withInput();
		}
	}

	public function postUpdateDefaultTabs() {
		
		if($this->userTabEntity->saveTab(\Input::all())) {
			\Session::flash('message', 'The Tab was successfully updated');
			return \Redirect::to('settings/custom-fields');
		} else {
			return \Redirect::to('settings/custom-fields')->withErrors(['There was a problem updating your tabs, please try again']);
		}
	}

	public function postSaveCustomFiles() {
		$sections = array(
			'files_1' => \Input::get('section1'),
			'files_2' => \Input::get('section2'),
			'files_3' => \Input::get('section3'),
			'files_4' => \Input::get('section4'),
			'files_5' => \Input::get('section5'),
			'files_6' => \Input::get('section6')
		);

		if($this->userEntity->find(\Auth::id())->updateCustomFiles($sections)) {
			\Session::flash('message', 'Client file sections was successfully updated');
			if(\Input::has('backToClientFiles'))
				return \Redirect::to('file/client-file/' . \Input::get('backToClientFiles'));
			else
				return \Redirect::to('settings/custom-fields');
		} else {
			return \Redirect::to('settings/custom-fields')->withErrors(['There was a problem updating your the sections, please try again']);
		}

	}

	public function getDeleteCustomTab($id) {
		$tab = $this->customFieldTabEntity->find($id);
		if($tab) {
			$tab->delete();
			\Session::flash('message', 'The Tab was successfully deleted');
			return \Redirect::to('settings/custom-fields');
		}
	}

	public function getCustomTab($id) {
		$tab = $this->customFieldTabEntity->find($id);
		if($tab) {
			$data 					= $this->data_view;
			$data['pageTitle'] 		= 'Custom Tab Settings';
			$data['portlet_title'] 	= 'Edit Custom Tab';
			$data['customForms']	= $this->customFormEntity->all();
			$data['tab']		= $tab;
			$data['pageSubTitle'] 	= '';
			$data['contentClass'] 	= 'settings';
			$data['icons'] 			= array_keys( \TaskLabel\TaskLabelEntity::get_instance()->getIcons() );			
			$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
			return \View::make( $data['view_path'] . '.settings.custom-fields.edit-custom-tab', $data );
		} else {
			return \Redirect::back()->withErrors(['There was a problem accessing the tab, please try again']); 
		}
	}

	public function postCustomTab($id) {
		$tab = $this->customFieldTabEntity->find($id);
		if($tab) {
			if($tab->updateCustomTab(\Input::all())) {
				\Session::flash('message', 'The Tab was successfully updated');
				if(\Input::get('backToClient'))
					return \Redirect::to('clients/custom/'.\Input::get('backToClient').'?custom='.$id);
				else
					return \Redirect::to('settings/custom-fields');
			} else {
				return \Redirect::back()->withErrors(['There was a problem updating the Tab, please try again']);
			}
		} else {
			return \Redirect::back()->withErrors(['There was a problem accessing the tab, please try again']);
		}
	}

}
