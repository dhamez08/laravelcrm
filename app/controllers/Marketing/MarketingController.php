<?php
namespace Marketing;
/**
 * Marketing Controller
 *
 * */

class MarketingController extends \BaseController {

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
		parent::__construct();
		$this->data_view 					= parent::setupThemes();
		$this->data_view['marketing_index']		= $this->data_view['view_path'] . '.page';
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
        $this->fileFolder 	 	= public_path() . '/documents';
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

	public function getIndex()
	{
		$data = $this->data_view;
		$data['pageTitle'] 			= 'Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_title'][1]	= 'SMS Marketing';
		$data['portlet_title'][2]	= 'Email Marketing';

		$get_credit					= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		if( $get_credit ){
			$data['sms_credit']		= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		}else{
			$data['sms_credit'] 	= 0;
		}
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.index-new', $data );
	}

	public function getOldIndex(){
		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Report';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Message Report';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['tag_id']				= \Input::has('tags') ? (\Input::get('tags') != 0 ) ? \Input::get('tags'):null:null;
		$data['list_customer']		= \Marketing\MarketingEntity::get_instance()->getCustomerList($data['tag_id']);
		$data['tags']			 	= \ClientTag\ClientTagEntity::get_instance()->getTagsByLoggedUser();
		$data['sms_sent']			= \SMSSent\SMSSent::userId( \Auth::id() )->orderBy('created_at','desc');
		$get_credit					= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		if( $get_credit ){
			$data['sms_credit']		= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		}else{
			$data['sms_credit'] = 0;
		}
		$data 						= array_merge($data,$this->getSetupThemes());
		//var_dump($data['sms_sent']->get()->toArray());
		return \View::make( $data['view_path'] . '.marketing.index', $data );
	}

	public function getSendClientSms(){
		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Send SMS';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['tag_id']				= \Input::has('tags') ? (\Input::get('tags') != 0 ) ? \Input::get('tags'):null:null;

		$customerFilters = array();
		if(\Input::get('age_min')) $customerFilters['min_age'] = \Input::get('age_min');
		if(\Input::get('age_max')) $customerFilters['max_age'] = \Input::get('age_max');
		if(\Input::get('marital_status')) $customerFilters['marital_status'] = \Input::get('marital_status');

		$data['list_customer']		= \Marketing\MarketingEntity::get_instance()->getCustomerList($data['tag_id'], 'Mobile', $customerFilters);
		

		$data['tags']			 	= \ClientTag\ClientTagEntity::get_instance()->getTagsByLoggedUser();
		$get_credit					= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		if( $get_credit ){
			$data['sms_credit']		= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		}else{
			$data['sms_credit'] = 0;
		}

		$data['checked_customers']	= \Session::get('session_sendsms');

		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.send_sms', $data );
	}

	public function postSendSmsMessage(){
		\Session::forget('session_sendsms');
		\Session::forget('sms_session');

		$customer_count = 0;
		foreach(\Input::get('sendsms', array()) as $sendsms) {
			if(!empty($sendsms['clientid'])) $customer_count++;
		}

		if( $customer_count > 0 ){
			if( \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id()) ){
				$send_sms = array();
				foreach(\Input::get('sendsms') as $key=>$val){
					if( isset($val['clientid'])){
						$send_sms[$key] = array(
							'clientid' => $val['clientid'],
							'number' => $val['number'],
							'name' => $val['name']
						);
					}
				}
				\Session::put('session_sendsms',$send_sms);
				return \Redirect::to('marketing/message-sms');
			}else{
				return \Redirect::back()->withErrors('Sorry you do not have enough credits.');
			}
		}else{
			return \Redirect::back()->withErrors('Choose customer first');
		}
	}

	public function getMessageSms(){

		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'SMS Message';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['sms_files']			= \SMSFIles\SMSFIles::userId(\Auth::id())->orderBy('created_at','desc')->get();

		/* TODO: fix file preview generator
		$thumbnailGenerator = new \Tristan\ThumbnailGenerator\ThumbnailGenerator;
		foreach ($data['sms_files'] as &$file) {
			$file->preview = $thumbnailGenerator->generateThumbnail('documents/' . $file->file);
		}
		*/

		$data['list_number']		= \Session::get('session_sendsms');
		$data['sms_templates']		= \User\User::find(\Auth::id())->smsTemplate;
		$data['checked_files']		= \Session::get('sms_session.files', array());
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.message', $data );
	}

	public function postSendSmsVerify(){
		if (trim(\Input::get('message')) == '') {
			return \Redirect::to('marketing/message-sms')->withErrors('You must enter a message');
		}else{
			$str_files = '';			
			if(count(\Input::get('attach_file')) > 0) {
				// files attach
				$files = \SMSFIles\SMSFIlesEntity::get_instance()->getFileAndConvertToURL( \Input::get('attach_file') );
				if( $files && count($files) > 0 ){
					$str_files = '';
					foreach($files as $file){
						$tinyurl = \helpers\TinyURL::tinyurl($file);
						if( $tinyurl && $tinyurl->state == 'ok' ){
							$sms_attach = $tinyurl->shorturl;
						}else{
							$sms_attach = $file;
						}
						$str_files .= $sms_attach."\n";
					}
					$str_files = 'Attach file : ' . $str_files;
				}
				// files attach
			}

			$message 			= trim(\Input::get('message'));
			$message 			.= ' ' . trim($str_files);
			$personalized 		= \Input::has('personalised');
			$message_characters = strlen($message);
			$sms_count = 0;
			// loop every message to total the credits needed
			$numbers = \Session::get('session_sendsms');

			foreach ($numbers as $key => $val) {
				$characters = 0;
				// get the number and the name
				if ($personalized) {
					$characters += strlen('Hi '. $message .'. ');
				}
				$characters += $message_characters;
				$sms_count  += ceil($characters/160);
			}
			$cred = \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
			if( $cred >= $sms_count ){
				$sms_session = array(
					'message' => trim(\Input::get('message')), //$message,
					'personalised' => $personalized,
					'required_credits' => $sms_count,
					'current_credits' => $cred,
					'files' => \Input::get('attach_file')
				);
				\Session::forget('sms_session');
				\Session::put('sms_session',$sms_session);
				return \Redirect::to('marketing/summary');
			}else{
				\Session::forget('session_sendsms');
				\Session::forget('sms_session');
				return \Redirect::to('marketing')->withErrors('Sorry you do not have enough credits.');
			}
		}
	}

	public function getSummary(){
		\Debugbar::info(\Session::get('sms_session'));
		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Message Summary';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['index_num']			= 1;
		$data['list_number']		= \Session::get('session_sendsms');
		$data['sms_session']		= \Session::get('sms_session');
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.summary', $data );
	}

	public function postSendSms(){
		$list_number = \Session::get('session_sendsms');
		$sms_session = \Session::get('sms_session');

		$success = false;
		$number_not_success = array();

		if (count($list_number) > 0) {
			$messagetosend = "";
			foreach ($list_number as $key => $val) {
				//personalize the message
				$client_id = $key;
				if ($sms_session['personalised']) {
					$messagetosend = 'Hi '. $val['name'] .'. '. $sms_session['message'];
				} else {
					$messagetosend = $sms_session['message'];
				}

				// Replace shortcodes
				$custObj = \Clients\Clients::find($client_id);
				$messagetosend = \EmailShortCodeReplacement::get_instance()->replace($custObj, $messagetosend);				

				//send sms thru textlocal gateway
				$txt_local = \Marketing\MarketingEntity::get_instance()->sendSMS(
					$val['number'],
					$messagetosend,
					\Auth::id()
				);
				//var_dump($txt_local);
				if( $txt_local->status != 'success' ){
					//input number
					/*
					 * this will be the list of unsuccessful sent number
					 * in time we can display this
					 * */
					$number_not_success[] = $val['number'];
				}else{
					//insert in the message table
					$message_data = array(
						'customer_id' => $val['clientid'],
						'sender' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'body' => $messagetosend,
						'to' => $val['number'],
						'subject' => 'Text message sent to client - ' . $val['name'],
						'direction' => 1,
						'method' => 2,
						'ref' => 'SMS_' . time()
					);
					$msg = \Message\MessageEntity::get_instance()->createOrUpdate($message_data);

					// create data in sending sms
					$sms_sent = array(
						'textlocal_msg_id'=>$txt_local->messages[0]->id,
						'textlocal_msg_recipient'=>$txt_local->messages[0]->recipient,
						'user_id'=>\Auth::id(),
						'customer_id'=>$val['clientid'],
						'message'=>$messagetosend,
						'from' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'client_name'=>$val['name'],
					);
					$obj_sms_sent = \SMSSent\SMSSentEntity::get_instance()->createOrUpdate($sms_sent);

					// create data for report purpose
					// get the api message response
					$msg_status = \Textlocal\TextlocalEntity::get_instance()->getMsgStatusID($txt_local->messages[0]->id);
					/*$sms_report = array(
						'sms_sent_id' => $obj_sms_sent->id,
						'to' => $txt_local->messages[0]->recipient ,
						'from' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'client_name' => $val['name'],
						'message' => $messagetosend,
						'status' => $msg_status->message->status,
						'customer_id' => $val['clientid'],
						'user_id' => \Auth::id()
					);
					\SMSReport\SMSReportEntity::get_instance()->createOrUpdate($sms_report);*/
				}
			}
			\Session::forget('session_sendsms');
			\Session::forget('sms_session');
			\Session::flash('message', 'Successfully SMS Send Message');
			return \Redirect::to('marketing');
		}
	}

	public function getSmsReceipt(){
		/*if(
			\Input::has('number') ||
			\Input::has('status') ||
			\Input::has('customID') ||
			\Input::has('datetime')
		){*/
			/*$data = array(
				$_REQUEST['number'],
				$_REQUEST['status'],
				$_REQUEST['customID'],
				$_REQUEST['datetime']
			);
			\SMSDelivery\SMSDeliveryReceipts::get_instance()->createOrUpdate($data);*/
		//}
		\Log::info('textlocal handling receipt ' . \Input::all());
		\Log::info('textlocal handling receipt ' . print_r(\Input::all()));
	}

    public function getTemplates(){
        $data = $this->data_view;
        $data['pageTitle'] 			= 'Email Templates';
        $data['contentClass'] 		= 'no-gutter';
        $data['fa_icons']			= 'user';
        $data['center_column_view'] = 'dashboard';

        $data 						= array_merge($data,$this->getSetupThemes());
        $data['email_templates'] = \User\User::find(\Auth::id())->emailTemplate()->where('type',2)->get();

        $dataAddTemplateModal = array();

        return \View::make( $data['view_path'] . '.marketing.template-listing', $data )
            ->nest('add_template_modal', $data['view_path'] . '.marketing.partials.add_template', $dataAddTemplateModal);
    }

    private function getCustomerEmails(){
        $this->get_customer_type = array(1,2,3);
        $group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
        $customers		= \Clients\ClientEntity::get_instance()->getCustomerHead($group_id, $this->get_customer_type);
        $email_arrays = array();

        foreach($customers as $customer){
            $emails = \Clients\Clients::find($customer['customer_id'])->emails->toArray();
            if(!empty($emails)){
                foreach($emails as $email){
                    $email['fullname'] = $customer['fullname'];
                    $email_arrays[] = $email;
                }
            }
        }

        return $email_arrays;
    }

    public function getSendClientEmail(){
        $data = $this->data_view;
        $data['pageTitle'] 			= 'Email Marketing';
        $data['contentClass'] 		= 'no-gutter';
        $data['portlet_title']		= 'Choose Contacts';
        $data 						= array_merge($data,$this->getSetupThemes());

        $type = array(1);
        $data['customer_list'] = \Clients\Clients::customerType($type)
            ->customerBelongsUser(\Auth::id())->with('emails');

        return \View::make( $data['view_path'] . '.marketing.compose-email', $data );
    }

    public function postCreateEmail(){
        $data = $this->data_view;
        $data['pageTitle'] 			= 'Email Marketing';
        $data['contentClass'] 		= 'no-gutter';
        $data['portlet_title']		= 'Create Email';
        $data 						= array_merge($data,$this->getSetupThemes());

        $emails = \Input::get('email', array());
        if(!empty($emails)){
            return \View::make( $data['view_path'] . '.marketing.email', $data );
        } else{
            return \Redirect::back()->withErrors('Choose customer first');
        }
    }

    public function postSaveEmailTemplate(){
        $emailTemplate = new \EmailTemplate\EmailTemplate;
        $emailTemplate->belongs_to = \Auth::id();
        $emailTemplate->name = \Input::get('template_name', '');
        $emailTemplate->subject = \Input::get('template_subject', '');
        $emailTemplate->body = \Input::get('template_body', '');
        $emailTemplate->type = 2; // Email marketing template
        $emailTemplate->save();
        if($emailTemplate) {
            \Session::flash('message', 'Successfully Added Template');
        } else {
            \Session::flash('message', 'Something went wrong');
        }
        return \Redirect::to('marketing/templates#personal');
    }

    public function getRemoveTemplate($id)
    {
        $emailTemplate = \EmailTemplate\EmailTemplate::find($id);
        if($emailTemplate->belongs_to == \Auth::id()) {
            $emailTemplate->delete();
            \Session::flash('message', 'Successfully Removed Template');
        } else {
            \Session::flash('message', 'Template does not belong to the logged in user.');
        }
        return \Redirect::to('marketing/templates#personal');
    }

    public function getUpdateTemplate($id)
    {
        $emailTemplate = \EmailTemplate\EmailTemplate::find($id);
        $data = $this->data_view;
        $data['pageTitle'] 			= 'Email Templates';
        $data['portlet_title'] = 'Update Template';
        $data['id'] = $emailTemplate->id;
        $data['name'] = $emailTemplate->name;
        $data['subject'] = $emailTemplate->subject;
        $data['body'] = $emailTemplate->body;
        $data = array_merge($data, \Dashboard\DashboardController::get_instance()->getSetupThemes());
        return \View::make($data['view_path'] . '.marketing.update-template', $data);
    }

    public function postUpdateTemplate($id){
        $emailTemplate = \EmailTemplate\EmailTemplate::find($id);
        $emailTemplate->name = \Input::get('template_name', '');
        $emailTemplate->subject = \Input::get('template_subject', '');
        $emailTemplate->body = \Input::get('template_body', '');
        $emailTemplate->save();
        if($emailTemplate) {
            \Session::flash('message', 'Successfully Updated Template');
        } else {
            \Session::flash('message', 'Something went wrong');
        }
        return \Redirect::to('marketing/templates#personal');
    }

    public function postFileUpload(){
        if( \Input::hasFile('upload-photo') ){
            $fileName = $this->_doUpload(\Input::file('upload-photo'));
            return \Response::json(array('success'=>true,'filePath'=>asset('public/documents/'.$fileName)));
        }else{
            return \Response::json(array('success'=>false,'msg'=>'Cannot upload, file.'));
        }
    }

    private function _doUpload($fileName){
        $file_name = $fileName->getClientOriginalName();
        $upload_success = $fileName->move($this->fileFolder, $file_name);
        if($upload_success ){
            return $file_name;
        }
    }

}
