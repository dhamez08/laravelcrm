<?php
namespace CustomFields;

class CustomFieldsController extends \BaseController {

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
		$data['tabActive'] 		= 'user-custom-fields';
		$data['clientTabs']		= \Config::get('crm.settings.customFields.clientTabs');
		$data['clientTabRows']	= $this->userEntity->find(\Auth::id())->tabs;
		$data['clientFiles']	= \Config::get('crm.settings.customFields.clientFiles');
		$data['clientFileRows']	= $this->userEntity->find(\Auth::id())->getClientFiles();
		$data['customTabs']		= $this->customFieldTabEntity->getTabsByLoggedUser();
		$data['clientForms']	= $this->customFormEntity->getFormsByLoggedUser();
		$data['clientFields']	= $this->customFieldEntity->getFieldsByLoggedUser();
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'settings';

		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data);exit();
		return \View::make( $data['view_path'] . '.settings.custom-fields.index', $data );
	}


	public function postAddField() {
		$rules = array(
			'label' 		=> 'required|min:3',
			'name' 			=> 'required|min:3|unique:users_custom_fields'
		);

		$messages = array(
			'label.required' => 'Label is required.',
			'label.min'=>'Label must have atleast 3 characters',
			'name.required' => 'Field name is required.',
			'name.min'=>'Field name must have atleast 3 characters',
			'name.unique'=>'Field name has already taken',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {

			$this->customFieldEntity->saveField(\Input::all());

			\Session::flash('message', 'The Field was successfully created');
			return \Redirect::to('settings/user-custom-fields');
		}else{
			\Input::flash();
			return \Redirect::to('settings/user-custom-fields')
			->withErrors($validator)
			->withInput();
		}
	}

	public function postEditField() {
		$rules = array(
			'label' 		=> 'required|min:3',
			'name' 			=> 'required|min:3|unique:users_custom_fields,name,'.\Input::get('field_id') //ignore the current id for unique validation
		);

		$messages = array(
			'label.required' => 'Label is required.',
			'label.min'=>'Label must have atleast 3 characters',
			'name.required' => 'Field name is required.',
			'name.min'=>'Field name must have atleast 3 characters',
			'name.unique'=>'Field name has already taken',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {

			$this->customFieldEntity->saveField(\Input::all());

			\Session::flash('message', 'The Field was successfully updated');
			return \Redirect::to('settings/user-custom-fields');
		}else{
			\Input::flash();
			return \Redirect::to('settings/user-custom-fields')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getDelete($id) {
		$field = $this->customFieldEntity->find($id);
		if($field) {
			$field->delete();
			\Session::flash('message', 'The Field was successfully deleted');
			return \Redirect::to('settings/user-custom-fields');
		}
	}




}
