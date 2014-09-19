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
		$data['clientFiles']	= \Config::get('crm.settings.customFields.clientFiles');
		$data['customTabs']		= $this->customFieldTabEntity->get();
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'settings';
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data);exit();
		return \View::make( $data['view_path'] . '.settings.custom-fields.index', $data );
	}

	public function postAddTab() {
		$rules = array(
			'tab' => 'required|min:3'
		);

		$messages = array(
			'tab.required' => 'Tab name is required.',
			'tab.min'=>'Tab name must have atleast 3 characters'
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

}
