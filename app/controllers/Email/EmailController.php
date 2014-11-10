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

	private $get_customer_type;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		//parent::__construct();
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->get_customer_type = array(1,2,3);
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
        $data['customFields']       = $data['customer']->customFieldsData();
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
		$data['customers']		= \Clients\ClientEntity::get_instance()->getCustomerList($group_id,$this->get_customer_type);
		return \View::make( $data['view_path'] . '.client-emails.index', $data );
	}

	public function postClient($clientId) {
		$btn_action = \Input::get('btn_action');
		$rules = array(
			'to' => 'required',
			'cc' => 'email',
			'bcc' => 'email',
			'subject' => 'required',
			'message' => 'required'
		);
		$messages = array(
			'to.required'=>'Customer is required',
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

			$customers = \Input::get('to');

			$data['subject'] = \Input::get('subject');
			$data['body'] = \Input::get('message');

			//code below is to replace the base64 image to real url so that it would be considered on the email provider

			preg_match_all('/src="([^"]*)"/', $data['body'], $matchesimage);

			if(count($matchesimage[0])>0) {
				foreach($matchesimage[1] as $matchImage) {
					if(preg_match('/(data:image\/(?:.*)+)/i', $matchImage)>0) {
						//valid image base64
						//so we need to upload it on the server and replace to the valid url
						$imagematchsrc = $matchImage;
						list($type, $imagematchsrc) = explode(';', $imagematchsrc);
						list(, $imagematchsrc)      = explode(',', $imagematchsrc);
						$imagematchsrc = base64_decode($imagematchsrc);
						$imageSavedName = \Auth::id().'_'.time().'.jpg';
						file_put_contents(public_path().'/documents/'.$imageSavedName, $imagematchsrc);

						$data['body'] = str_replace($matchImage, url('/public/documents/'.$imageSavedName), $data['body']);
					}
				}
			}

			//end replacement for base64 images
			
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

			foreach($customers as $customer) {

				preg_match_all("/\[((?:\w|\d|\s)+):((?:\w|\d|\s)+)\]/", $data['body'], $matches);

				if(!empty($matches)) {
					$data_matches = array();
					$no_of_matches = count($matches[0]);
					for($x=0; $x<$no_of_matches; $x++) {
						$data_matches[$x][] = $matches[0][$x];
						$data_matches[$x][] = $matches[1][$x];
						$data_matches[$x][] = $matches[2][$x];
					}

					foreach($data_matches as $key=>$dm) {
						$form_name = $dm[1];
						$field_name = str_replace(" ", "_", $dm[2]);

						$fieldValues = \Message\MessageEntity::get_instance()->getFormDataByFormNameAndFieldNameAndCustomer($form_name, $field_name, $customer);
						if(count($fieldValues)>0) {
							foreach($fieldValues as $fv) {
								$data['body'] = str_replace($dm[0], $fv->value, $data['body']);
							}
						}
					}
				}

				$custObj = \Clients\Clients::find($customer);

				$data['body'] = \EmailShortCodeReplacement::get_instance()->replace($custObj, $data['body']);

				if($custObj->emails()->count() > 0) {

					$data['to_email'] = $custObj->emails()->first()->email;
					$data['to_name'] = $custObj->first_name . " " . $custObj->last_name;
					$data['client_ref'] = "[REF:".$custObj->ref."]";
					if($btn_action=='send') {
						\Mail::send('emails.clients.index', $data, function($message) use ($data, $from_name, $from_email)
						{
							$message->from($from_email, $from_name);
							if($data['cc'])
								$message->cc($data['cc']);
							if($data['bcc'])
								$message->bcc($data['bcc']);
							if($data['client_files']) {
								$file_attach = explode("|", $data['client_files']);
								$message->attach(url('/') . '/public/' . $file_attach[1], array("as"=>$file_attach[0]));
							}
							$message->replyTo('dropbox.13554457@one23.co.uk', $from_name);
							$message->to($data['to_email'], $data['to_name'])->subject($data['subject'] . ' ' . $data['client_ref']);
						});
					}
					// build array to have message
					$new_message = array(
						'subject' => $data['subject'],
						'body' => $data['body'],
						'sender' => $from_name,
						'direction' => $btn_action=='send' ? '1':'3',
						'type' => '0',
						'added_date' => date('Y-m-d H:i:s'),
						'customer_id' => $customer,
						'to' => $data['to_email']
					);

					$smessage = \Message\Message::create($new_message);

					if($data['client_files']) {
						$file_attach = explode("|", $data['client_files']);
						$new_attachment = array(
							'message_id' => $smessage->id,
							'file' => $file_attach[1]
						);

						$smessageattach = \MessageAttachment\MessageAttachment::create($new_attachment);
					}

				}
			}

			if($btn_action=='send')
				\Session::flash('message', 'Email successfully sent');
			else
				\Session::flash('message', 'Email successfully saved to draft');

            if(\Input::get('back'))
                return \Redirect::to(\Input::get('back'));

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

	public function sendData() {
		$ref = \Input::get('ref');
		$sender = \Input::get('sender');
		$subject = \Input::get('subject');
		$body = \Input::get('body');

		//check if ref exists
		$client = \Clients\Clients::where('ref', $ref)->get();
		if($client->count()>0) {
			$new_message = array(
				'subject' => $subject,
				'body' => $body,
				'sender' => $sender,
				'direction' => '2',
				'added_date' => date('Y-m-d H:i:s'),
				'customer_id' => $client->first()->id
			);

			\Message\Message::create($new_message);
		}
	}

}
