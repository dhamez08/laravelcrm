<?php
namespace Marketing;
use Illuminate\Http\Response;

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
        $data['user_email_templates'] = \User\User::find(\Auth::id())->userEmailTemplate()->get();
        $data['layouts']        = \EmailLayout\EmailLayout::all();

        $dataAddTemplateModal = array();

        return \View::make( $data['view_path'] . '.marketing.template-listing', $data )
            ->nest('add_template_modal', $data['view_path'] . '.marketing.partials.add_template', $dataAddTemplateModal)
            ->nest('cropper_modal', $data['view_path'] . '.marketing.partials.image_cropper', $data)
            ->nest('mobile_preview_modal', $data['view_path'] . '.marketing.partials.mobile_preview', $data);
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

    public function getCreateEmail(){
        $data = $this->data_view;
        $data['pageTitle'] 			= 'Email Marketing';
        $data['contentClass'] 		= 'no-gutter';
        $data['portlet_title']		= 'Create Email';
        $data 						= array_merge($data,$this->getSetupThemes());

        $emails = \Input::get('email', array());
        if(!empty($emails)){
            $data['emails'] = $emails;
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
            $x_coord = intval(\Input::get('x_coord'));
            $y_coord = intval(\Input::get('y_coord'));
            $width = intval(\Input::get('width'));
            $height = intval(\Input::get('height'));
            $image_width = \Input::get('image_width');
            $image_height = \Input::get('image_height');

            $fileName = $this->_doUpload(\Input::file('upload-photo'), $x_coord, $y_coord, $width, $height, $image_width, $image_height);
            return \Response::json(array('success'=>true,'filePath'=>asset('public/documents/'.$fileName)));
        }else{
            return \Response::json(array('success'=>false,'msg'=>'Cannot upload, file.'));
        }
    }

    private function _doUpload($file, $x, $y, $width, $height, $image_width, $image_height){
        $file_name = $file->getClientOriginalName();
        $file_extension = $file->getClientOriginalExtension();

        $layer = \PHPImageWorkshop\ImageWorkshop::initFromPath($file->getRealPath());
        $layer->cropInPixel($width,$height,$x,$y,'LT');
        $layer->resizeInPixel($image_width, $image_height);

        $file_name = sha1($file_name.time()).".".$file_extension;
        $layer->save($this->fileFolder, $file_name, true);

        return $file_name;
    }


    public function getAjaxLayoutSectionList($layout_id){
        $sections = \EmailLayout\EmailLayout::find($layout_id)->section;
        foreach($sections as &$section){
            $section['display_image'] = asset('public/img/template_builder/'.$section['display_image']);
            $section['source_code'] = html_entity_decode($section['source_code']);
        }
        return \Response::json($sections);
    }

    public function postAjaxSaveTemplate(){
        $source_code = \Input::get('source_code');
        $template_id = \Input::get('template_id');
        $file        = \Input::get('thumbnail');
        $name        = \Input::get('name');
        $style       = \Input::get('style');

        $img = str_replace('data:image/png;base64,', '', $file);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $file_extension = 'png';
        $file_name = sha1(time()).".".$file_extension;

        \File::put($this->fileFolder.'/'.$file_name, $data);

        $layer = \PHPImageWorkshop\ImageWorkshop::initFromPath($this->fileFolder.'/'.$file_name);
        $layer->cropInPixel(655,470,50,0,'LT');
        $layer->resizeInPixel(655, 470);

        unlink($this->fileFolder.'/'.$file_name);

        $file_name = sha1($file_name.time()).".".$file_extension;
        $layer->save($this->fileFolder, $file_name, true);



        $user_id = \Auth::id();

        if($template_id == 0){
            $template = new \UserEmailTemplate\UserEmailTemplate;
            $template->source_code = \HTML::entities($source_code);
            $template->preview = $file_name;
            $template->user_id = $user_id;
            $template->name = $name;
            $template->style = $style;
            $template->save();
        } else {
            $template = \UserEmailTemplate\UserEmailTemplate::find($template_id);
            $template->source_code = $source_code;
            $template->preview = $file_name;
            $template->name = $name;
            $template->style = $style;
            $template->save();
        }

        return \Response::json(array('test'=>$source_code));
    }

    public function getAjaxEditTemplate(){
        $template_id = \Input::get('template_id');
        $template = \UserEmailTemplate\UserEmailTemplate::find($template_id);
        $template['source_code'] = \HTML::decode($template['source_code']);

        return \Response::json($template);
    }

    public function postAjaxDeleteTemplate(){
        $template_id = \Input::get('template_id');
        $template = \UserEmailTemplate\UserEmailTemplate::find($template_id);

        if(\Auth::id() == $template->user_id){
            $template->delete();
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return \Response::json($response);
    }

    public function getSendEmail(){
        $data['cc'] = 0;
        $data['bcc'] = 0;
        $data['subject'] = 'test subject';
        $data['body'] = '';
//        $data['footer'] = 'signature testing';
        $data['to_email'] = 'steve.warden1@btopenworld.com';
//		$data['to_email'] = 'dhamez08@gmail.com';
        $data['to_name'] = 'Tristan Flor';
        $data['client_ref'] = "[REF:12345]";

        $from_name = \Auth::user()->first_name . ' ' . \Auth::user()->last_name;
        $from_email = \Auth::user()->email;


        \Mail::send('emails.clients.index', $data, function($message) use ($data, $from_name, $from_email)
        {
            $message->from($from_email, $from_name);
            if($data['cc'])
                $message->cc($data['cc']);
            if($data['bcc'])
                $message->bcc($data['bcc']);
//            if($data['client_files']) {
//                $file_attach = explode("|", $data['client_files']);
//                $message->attach(url('/') . '/public/' . $file_attach[1], array("as"=>$file_attach[0]));
//            }
            $message->replyTo('dropbox.13554457@one23.co.uk', $from_name);
            $message->to($data['to_email'], $data['to_name'])->subject($data['subject'] . ' ' . $data['client_ref']);
        });
    }

    public function getPersonalTemplate($id){
        $emailTemplate = \EmailTemplate\EmailTemplate::find($id);
        return \Response::json($emailTemplate);
    }


    public function postSendEmail(){
        $rules = array(
            'subject' => 'required',
            'template_type' => 'required'
        );
        $messages = array(
            'subject.required'=>'Subject is required',
        );

        $validator = \Validator::make(\Input::all(), $rules, $messages);

        if($validator->passes()) {
            $template_type = \Input::get('template_type');
            if($template_type == 'plain'){
                $data['body'] = \Input::get('message');
            } else if($template_type == 'html'){
                $template_id = \Input::get('template_id');
                $template = \UserEmailTemplate\UserEmailTemplate::find($template_id);
                $body = \HTML::decode($template['source_code']);
                $data['style'] = $template['style'];

                $body = str_replace('contenteditable="true"','',$body);
                $data['body'] = str_replace('contenteditable','',$body);
            }

            $subject = \Input::get('subject');
            $emails = \Input::get('email');
            $from_name = \Auth::user()->first_name . ' ' . \Auth::user()->last_name;
            $from_email = \Auth::user()->email;

            foreach($emails as $email_id){
                $email_detail = \CustomerEmail\CustomerEmail::find($email_id);
                $to_id = $email_detail['customer_id'];
                $data['to_email'] = $email_detail['email'];


                $client_detail = \Clients\Clients::find($to_id);
                $data['subject'] = \EmailShortCodeReplacement::get_instance()->replace($client_detail, $subject);
                $data['body'] = \EmailShortCodeReplacement::get_instance()->replace($client_detail, $data['body']);
                $data['to_name'] = $client_detail['first_name'] . " " . $client_detail['last_name'];
                $data['client_ref'] = "[REF:".$client_detail['ref']."]";

                \Mail::send('emails.clients.marketing', $data, function($message) use ($data, $from_name, $from_email)
                {
                    $message->from($from_email, $from_name);
                    $message->replyTo('dropbox.13554457@one23.co.uk', $from_name);
                    $message->to($data['to_email'], $data['to_name'])->subject($data['subject'] . ' ' . $data['client_ref']);
                });
            }

            \Session::flash('message', 'Marketing email sent successfully.');
            return \Redirect::to('marketing/send-client-email');
        } else {
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }
    }

    public function getImageProxy(){
        //Turn off errors because the script already own uses "error_get_last"
        error_reporting(0);

//setup
        define('JSLOG', 'console.log'); //Configure alternative function log, eg. console.log, alert, custom_function
        define('PATH', 'images');//relative folder where the images are saved
        define('CCACHE', 60 * 5 * 1000);//Limit access-control and cache, define 0/false/null/-1 to not use "http header cache"
        define('TIMEOUT', 10);//Timeout from load Socket
        define('MAX_LOOP', 10);//Configure loop limit for redirect (location header)
        define('CROSS_DOMAIN', 0);//Enable use of "data URI scheme"

//constants
        define('EOL', chr(10));
        define('WOL', chr(13));
        define('GMDATECACHE', gmdate('D, d M Y H:i:s'));

        /*
        If execution has reached the time limit prevents page goes blank (off errors)
        or generate an error in PHP, which does not work with the DEBUG (from html2canvas.js)
        */
        $maxExec = (int) ini_get('max_execution_time');
        define('MAX_EXEC', $maxExec < 1 ? 0 : ($maxExec - 5));//reduces 5 seconds to ensure the execution of the DEBUG

        if(isset($_SERVER['REQUEST_TIME']) && strlen($_SERVER['REQUEST_TIME']) > 0) {
            $initExec = (int) $_SERVER['REQUEST_TIME'];
        } else {
            $initExec = time();
        }

        define('INIT_EXEC', $initExec);
        define('SECPREFIX', 'h2c_');

        $http_port = 0;

//set mime-type
        header('Content-Type: application/javascript');

        $param_callback = JSLOG;//force use alternative log error
        $tmp = null;//tmp var usage
        $response = array();

        /**
         * For show ASCII documents with "data uri scheme"
         * @param string $s    to encode
         * @return string      always return string
         */
        function asciiToInline($str) {
            $trans = array();
            $trans[EOL] = '%0A';
            $trans[WOL] = '%0D';
            $trans[' '] = '%20';
            $trans['"'] = '%22';
            $trans['#'] = '%23';
            $trans['&'] = '%26';
            $trans['\/'] = '%2F';
            $trans['\\'] = '%5C';
            $trans[':'] = '%3A';
            $trans['?'] = '%3F';
            $trans[chr(0)] = '%00';
            $trans[chr(8)] = '';
            $trans[chr(9)] = '%09';

            return strtr($str, $trans);
        }

        /**
         * Detect SSL stream transport
         * @return boolean|string        If returns string has an problem, returns true if ok
         */
        function supportSSL() {
            if(defined('SOCKET_SSL_STREAM')) {
                return true;
            }

            if(function_exists('stream_get_transports')) {
                /* PHP 5 */
                $ok = in_array('ssl', stream_get_transports());
                if($ok) {
                    defined('SOCKET_SSL_STREAM', '1');
                    return true;
                }
            } else {
                /* PHP 4 */
                ob_start();
                phpinfo(1);

                $info = strtolower(ob_get_clean());

                if(preg_match('/socket\stransports/', $info) !== 0) {
                    if(preg_match('/(ssl[,]|ssl [,]|[,] ssl|[,]ssl)/', $info) !== 0) {
                        defined('SOCKET_SSL_STREAM', '1');
                        return true;
                    } else {
                        return 'No SSL stream support detected';
                    }
                }
            }

            return 'Don\'t detected streams (finder error), no SSL stream support';
        }

        /**
         * set headers in document
         * @return void           return always void
         */
        function remove_old_files() {
            $p = PATH . '/';

            if(
                (MAX_EXEC === 0 || (time() - INIT_EXEC) < MAX_EXEC) && //prevents this function locks the process that was completed
                (file_exists($p) || is_dir($p))
            ) {
                $h = opendir($p);
                if(false !== $h) {
                    while(false !== ($f = readdir($h))) {
                        if(
                            is_file($p . $f) && is_dir($p . $f) === false &&
                            strpos($f, SECPREFIX) !== false &&
                            (INIT_EXEC - filectime($p . $f)) > (CCACHE * 2)
                        ) {
                            unlink($p . $f);
                        }
                    }
                }
            }
        }

        /**
         * this function does not exist by default in php4.3, get detailed error in php5
         * @return array   if has errors
         */
        function get_error() {
            if(function_exists('error_get_last') === false) {
                return error_get_last();
            }
            return null;
        }

        /**
         * enconde string in "json" (only strings), json_encode (native in php) don't support for php4
         * @param string $s    to encode
         * @return string      always return string
         */
        function JsonEncodeString($s, $onlyEncode=false) {
            $vetor = array();
            $vetor[0]  = '\\0';
            $vetor[8]  = '\\b';
            $vetor[9]  = '\\t';
            $vetor[10] = '\\n';
            $vetor[12] = '\\f';
            $vetor[13] = '\\r';
            $vetor[34] = '\\"';
            $vetor[47] = '\\/';
            $vetor[92] = '\\\\';

            $tmp = '';
            $enc = '';
            $j = strlen($s);

            for($i = 0; $i < $j; ++$i) {
                $tmp = substr($s, $i, 1);
                $c = ord($tmp);
                if($c > 126) {
                    $d = '000' . dechex($c);
                    $tmp = '\\u' . substr($d, strlen($d) - 4);
                } else {
                    if(isset($vetor[$c])) {
                        $tmp = $vetor[$c];
                    } else if(($c > 31) === false) {
                        $d = '000' . dechex($c);
                        $tmp = '\\u' . substr($d, strlen($d) - 4);
                    }
                }

                $enc .= $tmp;
            }

            if ($onlyEncode === true) {
                return $enc;
            } else {
                return '"' . $enc . '"';
            }
        }

        /**
         * set headers in document
         * @param boolean $nocache      If false set cache (if CCACHE > 0), If true set no-cache in document
         * @return void                 return always void
         */
        function setHeaders($nocache) {
            if($nocache === false && is_int(CCACHE) && CCACHE > 0) {
                //save to browser cache
                header('Last-Modified: ' . GMDATECACHE . ' GMT');
                header('Cache-Control: max-age=' . (CCACHE - 1));
                header('Pragma: max-age=' . (CCACHE - 1));
                header('Expires: ' . gmdate('D, d M Y H:i:s', INIT_EXEC + CCACHE - 1));
                header('Access-Control-Max-Age:' . CCACHE);
            } else {
                //no-cache
                header('Pragma: no-cache');
                header('Cache-Control: no-cache');
                header('Expires: '. GMDATECACHE .' GMT');
            }

            //set access-control
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Request-Method: *');
            header('Access-Control-Allow-Methods: OPTIONS, GET');
            header('Access-Control-Allow-Headers: *');
        }

        /**
         * Converte relative-url to absolute-url
         * @param string $u       set base url
         * @param string $m       set relative url
         * @return string         return always string, if have an error, return blank string (scheme invalid)
         */
        function relativeToAbsolute($u, $m) {
            if(strpos($m, '//') === 0) {//http link //site.com/test
                return 'http:' . $m;
            }

            if(preg_match('#^[a-zA-Z0-9]+[:]#', $m) !== 0) {
                $pu = parse_url($m);

                if(preg_match('/^(http|https)$/i', $pu['scheme']) === 0) {
                    return '';
                }

                $m = '';
                if(isset($pu['path'])) {
                    $m .= $pu['path'];
                }

                if(isset($pu['query'])) {
                    $m .= '?' . $pu['query'];
                }

                if(isset($pu['fragment'])) {
                    $m .= '#' . $pu['fragment'];
                }

                return relativeToAbsolute($pu['scheme'] . '://' . $pu['host'], $m);
            }

            if(preg_match('/^[?#]/', $m) !== 0) {
                return $u . $m;
            }

            $pu = parse_url($u);
            $pu['path'] = isset($pu['path']) ? preg_replace('#/[^/]*$#', '', $pu['path']) : '';

            $pm = parse_url('http://1/' . $m);
            $pm['path'] = isset($pm['path']) ? $pm['path'] : '';

            $isPath = $pm['path'] !== '' && strpos(strrev($pm['path']), '/') === 0 ? true : false;

            if(strpos($m, '/') === 0) {
                $pu['path'] = '';
            }

            $b = $pu['path'] . '/' . $pm['path'];
            $b = str_replace('\\', '/', $b);//Confuso ???

            $ab = explode('/', $b);
            $j = count($ab);

            $ab = array_filter($ab, 'strlen');
            $nw = array();

            for($i = 0; $i < $j; ++$i) {
                if(isset($ab[$i]) === false || $ab[$i] === '.') {
                    continue;
                }
                if($ab[$i] === '..') {
                    array_pop($nw);
                } else {
                    $nw[] = $ab[$i];
                }
            }

            $m  = $pu['scheme'] . '://' . $pu['host'] . '/' . implode('/', $nw) . ($isPath === true ? '/' : '');

            if(isset($pm['query'])) {
                $m .= '?' . $pm['query'];
            }

            if(isset($pm['fragment'])) {
                $m .= '#' . $pm['fragment'];
            }

            $nw = null;
            $ab = null;
            $pm = null;
            $pu = null;

            return $m;
        }

        /**
         * validate url
         * @param string $u  set base url
         * @return boolean   return always boolean
         */
        function isHttpUrl($u) {
            return preg_match('#^http(|s)[:][/][/][a-z0-9]#i', $u) !== 0;
        }

        /**
         * create folder for images download
         * @return boolean      return always boolean
         */
        function createFolder() {
            if(file_exists(PATH) === false || is_dir(PATH) === false) {
                return mkdir(PATH, 0755);
            }
            return true;
        }

        /**
         * create temp file which will receive the download
         * @param string  $basename        set url
         * @param boolean $isEncode        If true uses the "first" temporary name
         * @return boolean|array        If you can not create file return false, If create file return array
         */
        function createTmpFile($basename, $isEncode) {
            $folder = preg_replace('#[/]$#', '', PATH) . '/';
            if($isEncode === false) {
                $basename = SECPREFIX . sha1($basename);
            }

            //$basename .= $basename;
            $tmpMime = '.' . mt_rand(0, 1000) . '_';
            if($isEncode === true) {
                $tmpMime .= isset($_SERVER['REQUEST_TIME']) && strlen($_SERVER['REQUEST_TIME']) > 0 ? $_SERVER['REQUEST_TIME'] : (string) time();
            } else {
                $tmpMime .= (string) INIT_EXEC;
            }

            if(file_exists($folder . $basename . $tmpMime)) {
                return createTmpFile($basename, true);
            }

            $source = fopen($folder . $basename . $tmpMime, 'w');
            if($source !== false) {
                return array(
                    'location' => $folder . $basename . $tmpMime,
                    'source' => $source
                );
            }
            return false;
        }

        /**
         * download http request recursive (If found HTTP 3xx)
         * @param string $url               to download
         * @param resource $toSource        to download
         * @return array                    retuns array
         */
        function downloadSource($url, $toSource, $caller) {
            $errno = 0;
            $errstr = '';

            ++$caller;

            if($caller > MAX_LOOP) {
                return array('error' => 'Limit of ' . MAX_LOOP . ' redirects was exceeded, maybe there is a problem: ' . $url);
            }

            $uri = parse_url($url);
            $secure = strcasecmp($uri['scheme'], 'https') === 0;

            if($secure) {
                $response = supportSSL();
                if($response !== true) {
                    return array('error' => $response);
                }
            }

            $port = isset($uri['port']) && strlen($uri['port']) > 0 ? (int) $uri['port'] : ($secure === true ? 443 : 80);
            $host = ($secure ? 'ssl://' : '') . $uri['host'];

            $fp = fsockopen($host, $port, $errno, $errstr, TIMEOUT);
            if($fp === false) {
                return array('error' => 'SOCKET: ' . $errstr . '(' . ((string) $errno) . ')');
            } else {
                fwrite(
                    $fp, 'GET ' . (
                    isset($uri['path']) && strlen($uri['path']) > 0 ? $uri['path'] : '/'
                    ) . (
                    isset($uri['query']) && strlen($uri['query']) > 0 ? ('?' . $uri['query']) : ''
                    ) . ' HTTP/1.0' . WOL . EOL
                );

                if(isset($uri['user'])) {
                    $auth = base64_encode($uri['user'] . ':' . (isset($uri['pass']) ? $uri['pass'] : ''));
                    fwrite($fp, 'Authorization: Basic ' . $auth . WOL . EOL);
                }

                if(isset($_SERVER['HTTP_ACCEPT']) && strlen($_SERVER['HTTP_ACCEPT']) > 0) {
                    fwrite($fp, 'Accept: ' . $_SERVER['HTTP_ACCEPT'] . WOL . EOL);
                }

                if(isset($_SERVER['HTTP_USER_AGENT']) && strlen($_SERVER['HTTP_USER_AGENT']) > 0) {
                    fwrite($fp, 'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'] . WOL . EOL);
                }

                if(isset($_SERVER['HTTP_REFERER']) && strlen($_SERVER['HTTP_REFERER']) > 0) {
                    fwrite($fp, 'Referer: ' . $_SERVER['HTTP_REFERER'] . WOL . EOL);
                }

                fwrite($fp, 'Host: ' . $uri['host'] . WOL . EOL);
                fwrite($fp, 'Connection: close' . WOL . EOL . WOL . EOL);

                $isRedirect = true;
                $isBody = false;
                $isHttp = false;
                $encode = null;
                $mime = null;
                $data = '';

                while(false === feof($fp)) {
                    if(MAX_EXEC !== 0 && (time() - INIT_EXEC) >= MAX_EXEC) {
                        return array('error' => 'Maximum execution time of ' . ((string) (MAX_EXEC + 5)) . ' seconds exceeded, configure this with ini_set/set_time_limit or "php.ini" (if safe_mode is enabled)');
                    }

                    $data = fgets($fp);

                    if($data === false) {
                        continue;
                    }

                    if($isHttp === false) {
                        if(preg_match('#^HTTP[/]1[.]#i', $data) === 0) {
                            fclose($fp);//Close connection
                            $data = '';
                            return array('error' => 'This request did not return a HTTP response valid');
                        }

                        $tmp = preg_replace('#(HTTP/1[.]\\d |[^0-9])#i', '',
                            preg_replace('#^(HTTP/1[.]\\d \\d{3}) [\\w\\W]+$#i', '$1', $data)
                        );

                        if($tmp === '304') {
                            fclose($fp);//Close connection
                            $data = '';
                            return array('error' => 'Request returned HTTP_304, this status code is incorrect because the html2canvas not send Etag');
                        } else {
                            $isRedirect = preg_match('#^(301|302|303|307|308)$#', $tmp) !== 0;

                            if($isRedirect === false && $tmp !== '200') {
                                fclose($fp);
                                $data = '';
                                return array('error' => 'Request returned HTTP_' . $tmp);
                            }

                            $isHttp = true;

                            continue;
                        }
                    }

                    if($isBody === false) {
                        if(preg_match('#^location[:]#i', $data) !== 0) {//200 force 302
                            fclose($fp);//Close connection

                            $data = trim(preg_replace('#^location[:]#i', '', $data));

                            if($data === '') {
                                return array('error' => '"Location:" header is blank');
                            }

                            $nextUri = $data;
                            $data = relativeToAbsolute($url, $data);

                            if($data === '') {
                                return array('error' => 'Invalid scheme in url (' . $nextUri . ')');
                            }

                            if(isHttpUrl($data) === false) {
                                return array('error' => '"Location:" header redirected for a non-http url (' . $data . ')');
                            }
                            return downloadSource($data, $toSource, $caller);
                        } else if(preg_match('#^content[-]length[:]( 0|0)$#i', $data) !== 0) {
                            fclose($fp);
                            $data = '';
                            return array('error' => 'source is blank (Content-length: 0)');
                        } else if(preg_match('#^content[-]type[:]#i', $data) !== 0) {
                            $data = strtolower($data);

                            if (preg_match('#[;](\s|)+charset[=]#', $data) !== 0) {
                                $tmp2 = preg_split('#[;](\s|)+charset[=]#', $data);
                                $encode = isset($tmp2[1]) ? trim($tmp2[1]) : null;
                            }

                            $mime = trim(
                                preg_replace('/[;]([\\s\\S]|)+$/', '',
                                    str_replace('content-type:', '',
                                        str_replace('/x-', '/', $data)
                                    )
                                )
                            );

                            if(in_array($mime, array(
                                    'image/bmp', 'image/windows-bmp', 'image/ms-bmp',
                                    'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                                    'text/html', 'application/xhtml', 'application/xhtml+xml',
                                    'image/svg+xml', //SVG image
                                    'image/svg-xml' //Old servers (bug)
                                )) === false) {
                                fclose($fp);
                                $data = '';
                                return array('error' => $mime . ' mimetype is invalid');
                            }
                        } else if($isBody === false && trim($data) === '') {
                            $isBody = true;
                            continue;
                        }
                    } else if($isRedirect === true) {
                        fclose($fp);
                        $data = '';
                        return array('error' => 'The response should be a redirect "' . $url . '", but did not inform which header "Localtion:"');
                    } else if($mime === null) {
                        fclose($fp);
                        $data = '';
                        return array('error' => 'Not set the mimetype from "' . $url . '"');
                    } else {
                        fwrite($toSource, $data);
                        continue;
                    }
                }

                fclose($fp);

                $data = '';

                if($isBody === false) {
                    return array('error' => 'Content body is empty');
                } else if($mime === null) {
                    return array('error' => 'Not set the mimetype from "' . $url . '"');
                }

                return array(
                    'mime' => $mime,
                    'encode' => $encode
                );
            }
        }

        if(isset($_GET['callback']) && strlen($_GET['callback']) > 0) {
            $param_callback = $_GET['callback'];
        }

        if(isset($_SERVER['HTTP_HOST']) === false || strlen($_SERVER['HTTP_HOST']) === 0) {
            $response = array('error' => 'The client did not send the Host header');
        } else if(isset($_SERVER['SERVER_PORT']) === false) {
            $response = array('error' => 'The Server-proxy did not send the PORT (configure PHP)');
        } else if(MAX_EXEC < 10) {
            $response = array('error' => 'Execution time is less 15 seconds, configure this with ini_set/set_time_limit or "php.ini" (if safe_mode is enabled), recommended time is 30 seconds or more');
        } else if(MAX_EXEC <= TIMEOUT) {
            $response = array('error' => 'The execution time is not configured enough to TIMEOUT in SOCKET, configure this with ini_set/set_time_limit or "php.ini" (if safe_mode is enabled), recommended that the "max_execution_time =;" be a minimum of 5 seconds longer or reduce the TIMEOUT in "define(\'TIMEOUT\', ' . TIMEOUT . ');"');
        } else if(isset($_GET['url']) === false || strlen($_GET['url']) === 0) {
            $response = array('error' => 'No such parameter "url"');
        } else if(isHttpUrl($_GET['url']) === false) {
            $response = array('error' => 'Only http scheme and https scheme are allowed');
        } else if(preg_match('#[^A-Za-z0-9_[.]\\[\\]]#', $param_callback) !== 0) {
            $response = array('error' => 'Parameter "callback" contains invalid characters');
            $param_callback = JSLOG;
        } else if(createFolder() === false) {
            $err = get_error();
            $response = array('error' => 'Can not create directory'. (
                $err !== null && isset($err['message']) && strlen($err['message']) > 0 ? (': ' . $err['message']) : ''
                ));
            $err = null;
        } else {
            $http_port = (int) $_SERVER['SERVER_PORT'];

            $tmp = createTmpFile($_GET['url'], false);
            if($tmp === false) {
                $err = get_error();
                $response = array('error' => 'Can not create file'. (
                    $err !== null && isset($err['message']) && strlen($err['message']) > 0 ? (': ' . $err['message']) : ''
                    ));
                $err = null;
            } else {
                $response = downloadSource($_GET['url'], $tmp['source'], 0);
                fclose($tmp['source']);
            }
        }

        if(is_array($response) && isset($response['mime']) && strlen($response['mime']) > 0) {
            clearstatcache();
            if(false === file_exists($tmp['location'])) {
                $response = array('error' => 'Request was downloaded, but file can not be found, try again');
            } else if(filesize($tmp['location']) < 1) {
                $response = array('error' => 'Request was downloaded, but there was some problem and now the file is empty, try again');
            } else {
                $extension = str_replace(array('image/', 'text/', 'application/'), '', $response['mime']);
                $extension = str_replace(array('windows-bmp', 'ms-bmp'), 'bmp', $extension);
                $extension = str_replace(array('svg+xml', 'svg-xml'), 'svg', $extension);
                $extension = str_replace('xhtml+xml', 'xhtml', $extension);
                $extension = str_replace('jpeg', 'jpg', $extension);

                $locationFile = preg_replace('#[.][0-9_]+$#', '.' . $extension, $tmp['location']);
                if(file_exists($locationFile)) {
                    unlink($locationFile);
                }

                if(rename($tmp['location'], $locationFile)) {
                    //set cache
                    setHeaders(false);

                    remove_old_files();

                    if (CROSS_DOMAIN === 1) {
                        $mime = JsonEncodeString($response['mime'], true);
                        $mime = $response['mime'];
                        if ($response['encode'] !== null) {
                            $mime .= ';charset=' . JsonEncodeString($response['encode'], true);
                        }

                        $tmp = $response = null;

                        if (strpos($mime, 'image/svg') !== 0 && strpos($mime, 'image/') === 0) {
                            echo $param_callback, '("data:', $mime, ';base64,',
                            base64_encode(
                                file_get_contents($locationFile)
                            ),
                            '");';
                        } else {
                            echo $param_callback, '("data:', $mime, ',',
                            asciiToInline(
                                file_get_contents($locationFile)
                            ),
                            '");';
                        }
                    } else {
                        $tmp = $response = null;

                        $dir_name = dirname($_SERVER['SCRIPT_NAME']);
                        if ($dir_name === '\/' || $dir_name === '\\') {
                            $dir_name = '';
                        }

                        echo $param_callback, '(',
                        JsonEncodeString(
                            ($http_port === 443 ? 'https://' : 'http://') .
                            preg_replace('#:[0-9]+$#', '', $_SERVER['HTTP_HOST']) .
                            ($http_port === 80 || $http_port === 443 ? '' : (
                                ':' . $_SERVER['SERVER_PORT']
                            )) .
                            $dir_name. '/' .
                            $locationFile
                        ),
                        ');';
                    }
                    exit;
                } else {
                    $response = array('error' => 'Failed to rename the temporary file');
                }
            }
        }

        if(is_array($tmp) && isset($tmp['location']) && file_exists($tmp['location'])) {
            //remove temporary file if an error occurred
            unlink($tmp['location']);
        }

//errors
        setHeaders(true);//no-cache

        remove_old_files();

        echo $param_callback, '(',
        JsonEncodeString(
            'error: html2canvas-proxy-php: ' . $response['error']
        ),
        ');';
    }

}
