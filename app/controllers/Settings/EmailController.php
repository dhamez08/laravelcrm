<?php
namespace Settings;
/**
 * Email settings controller
 * 
 * */

class EmailController extends \BaseController {

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
	 * Logged in user object
	 *
	 */
	protected $user;

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
		$data['pageSubTitle'] 	= 'Settings for email.. duhhh.';
		$data['contentClass'] 	= '';

		/* Templates and Signatures */
		$data['email_templates']  = \User\User::find(\Auth::id())->emailTemplate;
		$data['email_signatures'] = \User\User::find(\Auth::id())->emailSignature;

		/* Initialize view data for modals */
		$dataAddTemplateModal = array();
		
		$dataAddSignatureModal = array();

		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.email.email', $data )
			->nest('add_template_modal'  , $data['view_path'] . '.settings.email.partials.modals.add_template', $dataAddTemplateModal)
			->nest('add_signature_modal' , $data['view_path'] . '.settings.email.partials.modals.add_signature', $dataAddSignatureModal);
	}

	public function postSaveTemplate()
	{
		$emailTemplate = new \EmailTemplate\EmailTemplate;
		$emailTemplate->belongs_to 	= \Auth::id();
		$emailTemplate->name 		= \Input::get('template_name', '');
		$emailTemplate->subject 	= \Input::get('template_subject', '');
		$emailTemplate->body 		= \Input::get('template_body', '');
		$emailTemplate->save();

		if($emailTemplate) {
			\Session::flash('message', 'Successfully Added Template');
		} else {
			\Session::flash('message', 'Something went wrong');
		}

		return \Redirect::to('settings/email');
	}

	public function getUpdateTemplate($id)
	{
		
	}

	public function postUpdateTemplate()
	{

	}

	public function postDeleteTemplate($id)
	{

	}

	public function postSaveSignature()
	{

	}

	public function postUpdateSignature()
	{

	}

	public function postDeleteEmailSignature()
	{

	}

}
