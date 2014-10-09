<?php
namespace CustomForms;

class CustomFormsController extends \BaseController {

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
	protected $customFormBuildEntity;

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
		$this->customFormBuildEntity = new \CustomFormBuild\CustomFormBuildEntity;
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
		$data['tabActive'] 		= 'custom-forms';
		$data['clientTabs']		= \Config::get('crm.settings.customFields.clientTabs');
		$data['clientTabRows']	= $this->userEntity->find(\Auth::id())->tabs;
		$data['clientFiles']	= \Config::get('crm.settings.customFields.clientFiles');
		$data['clientFileRows']	= $this->userEntity->find(\Auth::id())->getClientFiles();
		$data['customTabs']		= $this->customFieldTabEntity->getTabsByLoggedUser();
		$data['clientForms']	= $this->customFormEntity->getFormsByLoggedUser();
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'settings';

		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data);exit();
		return \View::make( $data['view_path'] . '.settings.custom-fields.index', $data );
	}

	public function postAddForm() {
		$rules = array(
			'form_name' 		=> 'required|min:3',
			'form_description' 	=> 'required|min:3'
		);

		$messages = array(
			'form_name.required' => 'Form name is required.',
			'form_name.min'=>'Form name must have atleast 3 characters',
			'form_description.required' => 'Form description is required.',
			'form_description.min'=>'Form description must have atleast 3 characters',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {

			$this->customFormEntity->saveForm(\Input::all());

			\Session::flash('message', 'The Form was successfully created');
			return \Redirect::to('settings/custom-forms');
		}else{
			\Input::flash();
			return \Redirect::to('settings/custom-forms')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getEdit($id, $action='')
	{

		$form = $this->customFormEntity->find($id);
		if($form) {
			$data 					= $this->data_view;
			$data['pageTitle'] 		= 'Edit Custom Form';
			$data['tabActive'] 		= 'custom-forms';
			$data['pageSubTitle'] 	= '';
			$data['contentClass'] 	= 'settings';
			$data['form']			= $form;
			$data['builds']			= $form->builds;

			$data['item_type']		= array(
										1=>'Text Field', 
										4=>'Textarea - Multi Line Text', 
										2=>'Dropdown Menu', 
										3=>'Checkbox', 
										5=>'Date Field', 
										6=>'Text Line / Heading'
									);

			$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());		
			return \View::make( $data['view_path'] . '.settings.custom-fields.partials.edit-custom-form', $data );
		} else {
			return \Redirect::back()->withErrors(['There was a problem accessing the form, please try again']);
		}
	}

	public function postPreview() {
		if(\Input::get('content')) {
			$pdf = \PDF::make();
		    $pdf->addPage(\Input::get('content'));
		    $pdf->send();
		}
	}

	public function getDelete($id) {
		$form = $this->customFormEntity->find($id);
		if($form) {
			$form->delete();
			\Session::flash('message', 'The Form was successfully deleted');
			return \Redirect::to('settings/custom-forms');
		}
	}

	public function postUpdateForm($id) {
		$form = $this->customFormEntity->find($id);
		if($form) {

			$form->name = \Input::get('custom_form_name');
			$form->desc = \Input::get('custom_form_desc');
			$form->save();

			// clear current form options
			$form->builds()->forceDelete();

			$item_name = \Input::get('item_name');
			$item_type = \Input::get('item_type');
			$item_placeholder = \Input::get('item_placeholder');
			$item_values = \Input::get('item_values');

			if($item_name) {
				foreach($item_name as $key => $name) {
					$values_json = "";
					if (trim($name)!="") {
						if ($item_type[$key]==2) {
							$values_list = array();
							$values = $item_values[$key];
							if (trim($values)!="") {
								$values_explode = explode(';', trim($values));
								$values_json = json_encode($values_explode);
							}
						}

						$item = array(
							'form_id' => $form->id,
							'label' => $name,
							'type' => $item_type[$key],
							'placeholder' => $item_placeholder[$key],
							'value' => $values_json
						);

						$this->customFormBuildEntity->saveItem($item);
					}
				}
			}

		}

		\Session::flash('message', 'The Form was successfully updated');
		return \Redirect::to('settings/custom-forms');
	}

}
