<?php
namespace Email;

class EmailController extends \BaseController {

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

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		//parent::__construct();
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
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
		echo "...";
	}

	private function _getClientData($clientId) {
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customer']			= \Clients\Clients::find($clientId);
		$data['currentClient']		= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['telephone']			= $data['customer']->telephone();
		$data['email']				= $data['customer']->emails();
		$data['url']				= $data['customer']->url();
		$data['profileImg']			= $data['customer']->profileImage();
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();

		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getCustomerTasks($clientId)
		->status(1)->with('label');

		return $data;
	}

	public function getClient($clientId) {
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

		$data 						= $this->_getClientData($clientId);
		$data 						= array_merge($data,$dashboard_data);
		$data['client_email'] = "";
		if($data['customer']->emails()->count() > 0) {
			$data['client_email'] = $data['customer']->emails()->first()->email;
		}
		return \View::make( $data['view_path'] . '.client-emails.index', $data );
	}

	public function postClient($clientId) {

		$rules = array(
			'to' => 'required|email',
			'cc' => 'email',
			'bcc' => 'email',
			'subject' => 'required',
			'message' => 'required'
		);
		$messages = array(
			'to.required'=>'To Email is required',
			'to.email'=>'To Email is not valid',
			'cc.email'=>'CC Email is not valid',
			'bcc.email'=>'BCC Email is not valid',
			'subject.required'=>'Subject is required',
			'message.required'=>'Message is required'
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if($validator->passes()) {

			$from_name = \Auth::user()->first_name . ' ' . \Auth::user()->last_name;
			$from_email = \Auth::user()->email;

			$data['cc'] = 0;
			$data['bcc'] = 0;
			$data['client_files'] = 0;

			$data['to_name'] = \Input::get('to_name');
			$data['client_ref'] = \Input::get('client_ref');
			$data['to_email'] = \Input::get('to');
			$data['subject'] = \Input::get('subject');
			$data['body'] = \Input::get('message');
			if(\Input::get('email_signature')!=='') {
				$signature = \EmailSignature\EmailSignature::find(\Input::get('email_signature'));
				if($signature) {
					$data['footer'] = $signature->body;
				}
			}

			if(\Input::get('cc') && \Input::get('cc')!=='') {
				$data['cc'] = \Input::get('cc');
			}

			if(\Input::get('bcc') && \Input::get('bcc')!=='') {
				$data['bcc'] = \Input::get('bcc');
			}

			if(\Input::get('client_files') && \Input::get('client_files')!=='') {
				$data['client_files'] = \Input::get('client_files');
			}

			
			\Mail::send('emails.clients.index', $data, function($message) use ($data, $from_name, $from_email)
			{
				$message->from($from_email, $from_name);
				if($data['cc'])
					$message->cc($data['cc']);
				if($data['bcc'])
					$message->bcc($data['bcc']);
				if($data['client_files']) {
					$message->attach(url('/') . '/public/' . $data['client_files']);
				}
				$message->replyTo('message@zeromyexcess.co.uk', $from_name);
				$message->to($data['to_email'], $data['to_name'])->subject($data['subject'] . ' ' . $data['client_ref']);
			});

			// build array to have message
			$new_message = array(
				'subject' => $data['subject'],
				'body' => $data['body'],
				'sender' => $from_name,
				'direction' => '1',
				'type' => '0',
				'added_date' => date('Y-m-d H:i:s'),
				'customer_id' => \Input::get('customer_id'),
				'to' => $data['to_email']
			);

			\Message\Message::create($new_message);

			\Session::flash('message', 'Email successfully sent');
			return \Redirect::back();

		} else {

			\Input::flash();
			return \Redirect::back()
			->withErrors($validator)
			->withInput();

		}
	}


	public function getUploadHandler() {
		$upload_handler = new \UploadHandler();
	}

	public function postUploadHandler() {
		$options = array(
			'upload_dir' => public_path() . '/documents/email/files/',
			'upload_url' => url('/') . '/public/documents/email/files/'
		);
		$upload_handler = new \UploadHandler($options);
	}

}
