<?php

namespace Messages;

class MessagesController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $destination_path = null;

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
		parent::__construct();
		$this->data_view = parent::setupThemes();
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->destination_path = "/public/document/library/own/";
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

	private function _messageCommon() {
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customers']		= \Clients\ClientEntity::get_instance()->getCustomerList($group_id,$this->get_customer_type);
		return $data;
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

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex($client_id){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data['messages'] = \Message\MessageEntity::get_instance()->getCustomerMessages($client_id);

		$clientData = $this->_getClientData($client_id); //get clients data

		$data['clientId'] = $client_id;

		$data['center_column_view']	= 'messages';

		$data 	= array_merge($data,$clientData,$dashboard_data);
		
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($client_id, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($client_id)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($client_id)->count();
		
		return \View::make( $data['view_path'] . '.clients.messages', $data );
	}

	public function getInbox(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Inbox';
		$data['messages'] 	= \Message\MessageEntity::get_instance()->listAllMessages();
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(),$dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function postInbox() {
		$messageids = \Input::get('messageid');
		$action = \Input::get('action_type');
		if(count($messageids)>0) {
			foreach ($messageids as $mid) {
				$message = \Message\MessageEntity::find($mid);
				if($action=='message_read') {
					$message->read_status = 1;
					$message->save();
				} elseif($action=='message_unread') {
					$message->read_status = 0;
					$message->save();
				} elseif($action=='message_delete') {
					$message->delete();
				}

			}
		}

		return \Redirect::back();
	}

	public function getSent(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Sent';
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$data['messages'] = \Message\MessageEntity::get_instance()->listAllSentMessages();
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(), $dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getDraft(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Draft';
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$data['messages'] = \Message\MessageEntity::get_instance()->listAllDraftMessages();
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(), $dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getTrash(){
		$data = $this->data_view;
		$data['center_view'] = 'trash';
		$data['message_title'] = 'Trash';
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$data['messages'] = \Message\MessageEntity::get_instance()->listAllTrashMessages();
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(), $dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function postTrash() {
		$messageids = \Input::get('messageid');
		$action = \Input::get('action_type');
		if(count($messageids)>0) {
			foreach ($messageids as $mid) {
				$message = \Message\MessageEntity::find($mid);
				if($action=='message_restore') {
					$message->restore();
				} elseif($action=='message_force_delete') {
					\Message\MessageEntity::get_instance()->force_delete($mid);
				}

			}
		}

		return \Redirect::back();
	}

	public function getCompose(){
		$data = $this->data_view;
		$data['center_view'] = 'compose';
		$data['message_title'] = 'Compose';
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(),$dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function postCompose() {
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
			return \Redirect::to('messages/inbox');

		} else {

			\Input::flash();
			return \Redirect::to('messages/inbox')
			->withErrors($validator)
			->withInput();

		}
	}

	public function getView(){
		$data = $this->data_view;
		$data['message'] = \Message\MessageEntity::get_instance()->getMessageDetails(\Input::get('message_id'))[0];

		//update the read status to 1
		$message = \Message\MessageEntity::find($data['message']->id);
		$message->read_status = 1;
		$message->save();

		$dataMessages = $this->_messageCommon();
		$data['message_title'] = $message->subject;

		if(\Input::get('show') == "modal"){

			$data = array_merge($data, $this->getSetupThemes(), $dataMessages);
			return \View::make($data['view_path'] . '.messages.partials.messageWidgetView', $data);
		} elseif (\Input::get('show') == "modal_complete") {
			$data = array_merge($data, $this->getSetupThemes(), $dataMessages);
			$data['modal_complete'] = true;
			return \View::make($data['view_path'] . '.messages.partials.messageWidgetView', $data);			
		} else {

			$data['center_view'] = 'inbox_view';
			$data = array_merge($data, $this->getSetupThemes(), $dataMessages);
			return \View::make($data['view_path'] . '.messages.index', $data);

		}
	}

	public function postView() {


		// $test = "Re:Test [REF:12342352351234123]";

		// preg_match('/Re:(.*?)\[REF:\d+\]/',$test, $display);

		// if(!empty($display) && isset($display[1])) {
		// 	echo $display[1];exit;
		// } else {
		// 	echo 'no match!';exit;
		// }

		$message = \Message\MessageEntity::get_instance()->getMessageDetails(\Input::get('message_id'))[0];
		preg_match('/Re:(.*?)\[REF:\d+\]/',$message->subject, $match);

		$rules = array(
			'to' => 'required'
		);
		$messages = array(
			'to.required'=>'Customer is required'
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if($validator->passes()) {

			$from_name = \Auth::user()->first_name . ' ' . \Auth::user()->last_name;
			$from_email = \Auth::user()->email;

			$customers = \Input::get('to');

			$data['body'] = $message->body;
			$message_attachments = \MessageAttachment\MessageAttachment::where('message_id',$message->id)->get();
			foreach($customers as $customer) {

				$custObj = \Clients\Clients::find($customer);

				if($custObj->emails()->count() > 0) {

					$data['to_email'] = $custObj->emails()->first()->email;
					$data['to_name'] = $custObj->first_name . " " . $custObj->last_name;
					$data['client_ref'] = "[REF:".$custObj->ref."]";

					$subject = "";

					if(!empty($match) && isset($match[1])) {
						$subject = trim($match[1]);
					} else {
						$subject = trim($message->subject);
					}

					$data['subject'] = $subject;

					\Mail::send('emails.clients.index', $data, function($m) use ($data, $from_name, $from_email, $message_attachments, $message, $subject)
					{
						$m->from($from_email, $from_name);

						if(count($message_attachments)>0) {
							foreach($message_attachments as $attachment) {
								$m->attach(url('/') . '/public/' . $attachment->file);
							}
						}
						$m->replyTo('dropbox.13554457@one23.co.uk', $from_name);
						$m->to($data['to_email'], $data['to_name'])->subject($subject . ' ' . $data['client_ref']);
					});

					// build array to have message
					$new_message = array(
						'subject' => $subject,
						'body' => $data['body'],
						'sender' => $from_name,
						'direction' => '1',
						'type' => '0',
						'added_date' => date('Y-m-d H:i:s'),
						'customer_id' => $customer,
						'to' => $data['to_email']
					);

					$smessage = \Message\Message::create($new_message);

					if(count($message_attachments)>0) {
						foreach($message_attachments as $attachment) {
							$new_attachment = array(
								'message_id' => $smessage->id,
								'file' => $attachment->file
							);

							$smessageattach = \MessageAttachment\MessageAttachment::create($new_attachment);
						}
					}
				}
			}

			\Session::flash('message', 'Email successfully sent');
			return \Redirect::back();

		} else {

			\Input::flash();
			return \Redirect::back()
			->withErrors($validator)
			->withInput();

		}
	}

	public function getReply(){
		$data = $this->data_view;
		$data['message'] = \Message\MessageEntity::get_instance()->getMessageDetails(\Input::get('message_id'))[0];
		$data['center_view'] = 'reply';
		$data['message_title'] = 'Reply';
		$dataMessages 					= $this->_messageCommon();
		$data 							= array_merge($data,$this->getSetupThemes(), $dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function postReply() {
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
						$message->to($data['to_email'], $data['to_name'])->subject($data['subject']);
					});

					// build array to have message
					$new_message = array(
						'subject' => $data['subject'],
						'body' => $data['body'],
						'sender' => $from_name,
						'direction' => '1',
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

			\Session::flash('message', 'Email successfully sent');
			return \Redirect::back();

		} else {

			\Input::flash();
			return \Redirect::back()
			->withErrors($validator)
			->withInput();

		}
	}

	public function getDelete($id) {
		$message = \Message\MessageEntity::find($id);
		if($message) {
			$message->delete();
			if(\Input::get('back') && \Input::get('back')=='yes') {
				\Session::flash('message', 'Message Successfully moved to trash.');
				return \Redirect::back();
			}
			else {
				return \Redirect::to('messages/trash');
			}
		}

		return \Redirect::back();
	}

	public function getResend() {
		$id = \Input::get('message_id');
		$message = \Message\MessageEntity::find($id);
		if($message) {

			$from_name = \Auth::user()->first_name . ' ' . \Auth::user()->last_name;
			$from_email = \Auth::user()->email;

			$custObj = \Clients\Clients::find($message->customer_id);

			if($custObj->emails()->count() > 0) {

				$data['to_email'] = $custObj->emails()->first()->email;
				$data['to_name'] = $custObj->first_name . " " . $custObj->last_name;
				$data['client_ref'] = "[REF:".$custObj->ref."]";
				$data['body'] = $message->body;
				$message_attachments = \MessageAttachment\MessageAttachment::where('message_id',$message->id)->get();

				\Mail::send('emails.clients.index', $data, function($m) use ($data, $from_name, $from_email, $message_attachments, $message)
				{
					$m->from($from_email, $from_name);

					if(count($message_attachments)>0) {
						foreach($message_attachments as $attachment) {
							$m->attach(url('/') . '/public/' . $attachment->file);
						}
					}
					$m->replyTo('dropbox.13554457@one23.co.uk', $from_name);
					$m->to($data['to_email'], $data['to_name'])->subject($message->subject);
				});

				// build array to have message
				$new_message = array(
					'subject' => $message->subject,
					'body' => $message->body,
					'sender' => $from_name,
					'direction' => '1',
					'type' => '0',
					'added_date' => date('Y-m-d H:i:s'),
					'customer_id' => $message->customer_id,
					'to' => $data['to_email']
				);

				$smessage = \Message\Message::create($new_message);

				if(count($message_attachments)>0) {
					foreach($message_attachments as $attachment) {
						$new_attachment = array(
							'message_id' => $smessage->id,
							'file' => $attachment->file
						);

						$smessageattach = \MessageAttachment\MessageAttachment::create($new_attachment);
					}
				}

				\Session::flash('message', 'Email successfully sent');
				return \Redirect::back();
			}
		}

		return \Redirect::back();
	}

	public function getMessagesByCustomer($clientId) {
		$data = $this->data_view;
		$data['recent_messages']	= \Message\MessageEntity::get_instance()->summaryRecentMessages($clientId);
		return \View::make( $data['view_path'] . '.messages.partials.messages_by_customer', $data );
	}
}
