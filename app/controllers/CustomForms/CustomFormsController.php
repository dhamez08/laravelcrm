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

	public function in_array_r($needle, $haystack, $strict = false) {
	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }
	    return false;
	}

	public function postSaveForm() {
		$content = trim(\Input::get('content'));
		$form_id_ctr = trim(\Input::get('form_id_ctr'));
		$form_name = \Input::get('form_name');
		$form = $this->customFormEntity->find(\Input::get('form_id'));
		
		$doc = new \DOMDocument;
		$fields = array();
		if ( !$doc->loadhtml($content) ) {
		  return \Redirect::back()->withErrors(['There was a problem updating the form, please try again']);
		} else {

			$form->name = $form_name;
			$form->build = $content;
			$form->last_field_ctr = $form_id_ctr;
			$form->save();

			// clear current form build
			$form->builds()->forceDelete();

			$xpath = new \DOMXpath($doc);

			$inputs = $xpath->query('//input | //select | //textarea');


			foreach($inputs as $input) {
				if(!$this->in_array_r($input->getAttribute('name'), $fields)) {
			  	$fields[] = array(
				  		'name'=>$input->getAttribute('name')
				  	);
				}
			}

			foreach ($fields as $key => $field) {
				$item = array(
					'form_id' => $form->id,
					'name' => $field['name']
				);

				$this->customFormBuildEntity->saveItem($item);
			}

			\Session::flash('message', 'The Form was successfully updated');
			return \Redirect::back();

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

	public function postSubmitData() {

		$datas = array();

		$length = 20;
		$ref_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

		foreach(\Input::all() as $key=>$input) {
			if($key!=='_token' && $key!=='form_id' && $key!=='customer_id' && $key!=='custom_id') {
				$datas[$key] = $input;
			}
		}

		foreach($datas as $key=>$data) {
			$row = array(
				'form_id'		=>	\Input::get('form_id'),
				'customer_id'	=>	\Input::get('customer_id'),
				'field_name'	=>	$key,
				'ref_id'		=>	$ref_id,
				'value'			=>	is_array($data) ? json_encode($data): $data
			);

			//insert
			\CustomFormData\CustomFormData::create($row);

		}

		\Session::flash('message', 'Successfully Added!');
		return \Redirect::to('clients/custom/'.\Input::get('customer_id').'?custom='.\Input::get('custom_id'));
	}

	private function isJson($string) {
	 json_decode($string);
	 return (json_last_error() == JSON_ERROR_NONE);
	}

	public function getFormData($ref_id) {
		$formDataEntity = new \CustomFormData\CustomFormDataEntity;

		$form_id = "";
		$customer_id="";

		$data = array();

		$fields = $formDataEntity->where('ref_id', $ref_id)->get();

		foreach ($fields as $field) {
			$data[$field->field_name] = $this->isJson($field->value) ? json_decode($field->value) : $field->value;
			$form_id = $field->form_id;
			$customer_id = $field->customer_id;
		}

		//dd($data);

		//get the form build
		$formEntity = new \CustomForm\CustomFormEntity;
		$form= $formEntity->find($form_id);

		$doc = new \DOMDocument;
		$doc->loadhtml($form->build);
		$xpath = new \DOMXpath($doc);

		$inputs = $xpath->query('//input | //select | //textarea');


		foreach($inputs as $input) {

			$input_name = str_replace(" ", "_", $input->getAttribute('name'));

			if($input->nodeName=='input' && $input->getAttribute('type')=='text') {
				$input->setAttribute('value', $data[$input_name]);
				$input->setAttribute('disabled', "disabled");
			} elseif($input->nodeName=='select' && !$input->hasAttribute('multiple')) {
				$nodes = $input->childNodes;
				foreach ($nodes as $node) {
					if(strtolower($node->nodeValue)==strtolower($data[$input_name])) {
						$node->setAttribute('selected', 'selected');

					}
				}

				$input->setAttribute('disabled', "disabled");

			} elseif($input->nodeName=='input' && $input->getAttribute('type')=='radio') {
				if($input->getAttribute('value')==$data[$input_name]) {
					$input->setAttribute('checked','checked');
				}
				$input->setAttribute('disabled', "disabled");
			} elseif($input->nodeName=='textarea') {
				$input->nodeValue = $data[$input_name];
				$input->setAttribute('disabled', "disabled");
			} elseif($input->nodeName=='input' && $input->getAttribute('type')=='checkbox') {
				$input_name = str_replace("[]", "", $input_name);

				if(in_array($input->getAttribute('value'), $data[$input_name])) {
					$input->setAttribute('checked','checked');
				}
			} elseif($input->nodeName=='select' && $input->hasAttribute('multiple')) {
				$input_name = str_replace("[]", "", $input_name);
				$input->setAttribute('size',count($data[$input_name]));
				$nodes = $input->childNodes;
				foreach ($nodes as $node) { 
					if(in_array($node->nodeValue, $data[$input_name])) {
						$node->setAttribute('selected', 'selected');
					}
				}

				$input->setAttribute('disabled', "disabled");
			}
			
		}

		//echo '<link href="http://one23.dev/public/admin/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">';


		return $doc->saveHTML();

		//dd($form->build);
	}

	public function getDeleteFormData($ref_id) {
		$formDataEntity = new \CustomFormData\CustomFormDataEntity;

		$data = $formDataEntity->where('ref_id', $ref_id)->forceDelete();

		if($data) {
			\Session::flash('message', 'Successfully deleted!');
			return \Redirect::back();
		}

		return \Redirect::back()->withErrors(['There was a problem deleting the form data, please try again']);
	}

}
