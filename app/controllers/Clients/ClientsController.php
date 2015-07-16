<?php
namespace Clients;
/**
 * Clients Controller
 *
 * */
use \Carbon\Carbon;

class ClientsController extends \BaseController {

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
	 * Person Title like
	 * Mr, Ms, etc...
	 * */
	protected $title;
	/**
	 * Person Marital Status
	 * */
	protected $marital_status;
	/**
	 * Person Living Status
	 * */
	protected $living_status;
	/**
	 * Person Employment Status
	 * */
	protected $employment_status;
	/**
	 * Person Phone for
	 * */
	protected $phone_for;
	/**
	 * Person Email for
	 * */
	protected $email_for;
	/**
	 * Person Website for
	 * */
	protected $website_for;
	/**
	 * Person Website is
	 * */
	protected $website_is;
	/**
	 * Children Relation to client
	 * */
	protected $relationship_to_client;
	/**
	 * Address type
	 * */
	protected $address_type;

	/**
	 * Opportunity milestone
	 * */
	protected $opportunity_milestones;

	/**
	 * Opportunity probability
	 * */
	protected $opportunity_probabilities;

	/**
	 * People / Family Relationship
	 * */
	protected $people_relationship;

	private $get_customer_type;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		$this->data_view 					= parent::setupThemes();
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-full-width';
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';

		$this->data_view['user_list']		= array();

		$this->title 						= \Config::get('crm.person_title');
		$this->marital_status 				= \Config::get('crm.marital_status');
		$this->living_status 				= \Config::get('crm.living_status');
		$this->employment_status 			= \Config::get('crm.employment_status');
		$this->phone_for 					= \Config::get('crm.phone_for');
		$this->email_for 					= \Config::get('crm.email_for');
		$this->website_for 					= \Config::get('crm.website_for');
		$this->website_is 					= \Config::get('crm.website_is');
		$this->relationship_to_client		= \Config::get('crm.relationship_to_client');
		$this->address_type					= \Config::get('crm.address_type');
		$this->opportunity_milestones		= \Config::get('crm.opportunity_milestone');
		$this->opportunity_probabilities	= \Config::get('crm.opportunity_probability');
		$this->people_relationship			= \Config::get('crm.people_relationship');
		$this->get_customer_type			= array(1,2,3);
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

	public function getTitleClient(){
		return $this->title;
	}

	public function getMaritalStatus(){
		return $this->marital_status;
	}

	public function getLivingStatus(){
		return $this->living_status;
	}

	public function getEmploymentStatus(){
		return $this->employment_status;
	}

	public function getPhoneFor(){
		return $this->phone_for;
	}

	public function getEmailFor(){
		return $this->email_for;
	}

	public function getWebsiteFor(){
		return $this->website_for;
	}

	public function getWebsiteIs(){
		return $this->website_is;
	}

	public function getRelationshipToClient(){
		return $this->relationship_to_client;
	}

	public function getAddressType(){
		return $this->address_type;
	}

	public function getPeopleRelationship(){
		return $this->people_relationship;
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
	public function getIndex(){
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']			= 'user';
		$data['tag_id']				= \Input::has('tags') ? (\Input::get('tags') != 0 ) ? \Input::get('tags'):null:null;
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;

		$data['user_list'] = array(
			\Auth::id() => 'Myself Only',
			'all'		=> 'All',
		);
		$sub_users = \CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->getGroupUsersList();
		if(count($sub_users) > 0) {
			foreach ($sub_users as $su) {
				$data['user_list'][$su->user_id] = $su->first_name . ' ' . $su->last_name;
			}
		}
		$allUsers = $data['user_list'];
		unset($allUsers['all']);
		$allUsers = array_keys($allUsers);

		$customerFilters = array();
		if(\Input::get('age_min')) $customerFilters['min_age'] = \Input::get('age_min');
		if(\Input::get('age_max')) $customerFilters['max_age'] = \Input::get('age_max');
		if(\Input::get('marital_status')) $customerFilters['marital_status'] = \Input::get('marital_status');
		if(\Input::get('user')) $customerFilters['user'] = \Input::get('user');

		if(!empty($customerFilters['user'])) {
			if($customerFilters['user'] == 'all')
				$customerFilters['user'] = $allUsers;
			else
				$customerFilters['user'] = array($customerFilters['user']);
		}

		$data['array_customer']		= \Clients\ClientEntity::get_instance()->getCustomerHead($group_id, $this->get_customer_type, $customerFilters);
		$data['tags']			 	= \ClientTag\ClientTagEntity::get_instance()->getTagsByLoggedUser();
		$data['center_column_view'] = 'dashboard';	

		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.clients.index', $data );
	}

	public function getConfirmPhoneDelete($id, $client, $token, $from){
		if( strcmp($id . \Session::token(), $token) == 0 ){
			$phone = \CustomerTelephone\CustomerTelephone::find($id);
			//echo $phone->number;
			$phone->delete();
			\Session::flash('message', 'Successfully Delete Phone Customer');
			if( $from == 'company' ){
				return \Redirect::action('Clients\ClientsController@getEditCompany',array('clientId'=>$client));
			}else{
				return \Redirect::action('Clients\ClientsController@getEdit',array('clientId'=>$client));
			}
		}else{
			echo 'nice try hacker';
			die();
		}
	}
	public function getConfirmUrlDelete($id, $client, $token, $from){
		if( strcmp($id . \Session::token(), $token) == 0 ){
			$url = \CustomerUrl\CustomerUrl::find($id);
			//echo $phone->number;
			$url->delete();
			\Session::flash('message', 'Successfully Delete Website');
			if( $from == 'company' ){
				return \Redirect::action('Clients\ClientsController@getEditCompany',array('clientId'=>$client));
			}else{
				return \Redirect::action('Clients\ClientsController@getEdit',array('clientId'=>$client));
			}
		}else{
			echo 'nice try hacker';
			die();
		}
	}
	public function getConfirmMailDelete($id, $client, $token, $from){
		if( strcmp($id . \Session::token(), $token) == 0 ){
			$mail = \CustomerEmail\CustomerEmail::find($id);
			//echo $phone->number;
			$mail->delete();
			\Session::flash('message', 'Successfully Delete Email');
			if( $from == 'company' ){
				return \Redirect::action('Clients\ClientsController@getEditCompany',array('clientId'=>$client));
			}else{
				return \Redirect::action('Clients\ClientsController@getEdit',array('clientId'=>$client));
			}
		}else{
			echo 'nice try hacker';
			die();
		}
	}
	public function getConfirmPersonDelete($id, $client, $token){
		if( strcmp($id . \Session::token(), $token) == 0 ){
			$person = \Clients\Clients::find($id);
			if( $person->telephone()->count() > 0 ){
				$person->telephone()->delete();
			}
			if( $person->address()->count() > 0 ){
				$person->address()->delete();
			}
			if( $person->emails()->count() > 0 ){
				$person->emails()->delete();
			}
			if( $person->url()->count() > 0 ){
				$person->url()->delete();
			}
			$person->delete();

			// Log Activity
			//\Activity\ActivityEntity::get_instance()->logActivity('Remove Client', $id);

			\Session::flash('message', 'Successfully Delete Person');
			return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$client));
		}else{
			echo 'nice try hacker';
			die();
		}
	}

	public function getConfirmChildDelete($id, $client, $token) {
		if( strcmp($id . \Session::token(), $token) == 0 ){
			$person = \Clients\Clients::find($id);
			if( $person->telephone()->count() > 0 ){
				$person->telephone()->delete();
			}
			if( $person->address()->count() > 0 ){
				$person->address()->delete();
			}
			if( $person->emails()->count() > 0 ){
				$person->emails()->delete();
			}
			if( $person->url()->count() > 0 ){
				$person->url()->delete();
			}
			$person->delete();

			// Log Activity
			// \Activity\ActivityEntity::get_instance()->logActivity('Remove Client', $id);

			\Session::flash('message', 'Successfully Deleted Child');
			return \Redirect::action('Clients\ClientsController@getEdit',array('clientId'=>$client));
		}else{
			echo 'nice try hacker';
			die();
		}		
	}

	public function getDeleteClient($id, $token)
	{
		if( strcmp(\Session::token(), $token) == 0 ){
			$person = \Clients\Clients::find($id);
			if( $person->telephone()->count() > 0 ){
				$person->telephone()->delete();
			}
			if( $person->address()->count() > 0 ){
				$person->address()->delete();
			}
			if( $person->emails()->count() > 0 ){
				$person->emails()->delete();
			}
			if( $person->url()->count() > 0 ){
				$person->url()->delete();
			}
            if( $person->task()->count() > 0){
                $person->task()->delete();
            }
			$person->delete();

			// Log Activity
			//\Activity\ActivityEntity::get_instance()->logActivity('Remove Client', $id);

			\Session::flash('message', 'Successfully Deleted Client');
			return \Redirect::action('Clients\ClientsController@getIndex');
		}else{
			echo 'nice try hacker';
			die();
		}		
	}

	public function getCreate(){
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'create';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Add Client';
		$data['fa_icons']			= 'user';
		$data['title']				= $this->getTitleClient();
		$data['maritalStatus']		= $this->getMaritalStatus();
		$data['livingStatus']		= $this->getLivingStatus();
		$data['employmentStatus']	= $this->getEmploymentStatus();
		$data['phoneFor']			= $this->getPhoneFor();
		$data['emailFor']			= $this->getEmailFor();
		$data['relationToClient']	= $this->getRelationshipToClient();
		$data['addressType']		= $this->getAddressType();
		$data['websiteType']		= $this->getWebsiteFor();
		$data['websiteIs']			= $this->getWebsiteIs();
		$data 						= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		$data['center_column_view'] = 'dashboard';
		$data['user_list']			= array();

		return \View::make( $data['view_path'] . '.clients.create', $data );
	}

	public function getEdit($clientId){
		$data 						= $this->data_view;
		$data['customer']			= \Clients\Clients::find($clientId);
		$data['currentClient']		= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['children']			= \Clients\ClientEntity::get_instance()->getCustomerChildren();
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'create';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Update Client - ' . $data['currentClient']->displayCustomerName();
		$data['fa_icons']			= 'user';
		$data['title']				= $this->getTitleClient();
		$data['maritalStatus']		= $this->getMaritalStatus();
		$data['livingStatus']		= $this->getLivingStatus();
		$data['employmentStatus']	= $this->getEmploymentStatus();
		$data['phoneFor']			= $this->getPhoneFor();
		$data['emailFor']			= $this->getEmailFor();
		$data['relationToClient']	= $this->getRelationshipToClient();
		$data['addressType']		= $this->getAddressType();
		$data['websiteType']		= $this->getWebsiteFor();
		$data['websiteIs']			= $this->getWebsiteIs();
		//$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;

		$data['telephone']			= $data['customer']->telephone();
		$data['email']				= $data['customer']->emails();
		$data['url']				= $data['customer']->url();
		$data['from']				= 'client';
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data 						= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		$data['center_column_view'] = 'dashboard';

		return \View::make( $data['view_path'] . '.clients.edit', $data );
	}

	public function getFiles()
	{
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client - Files';
		$data['contentClass'] 	= '';
		$data 					= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		$data['center_column_view'] = 'files';
		return \View::make( $data['view_path'] . '.clients.index', $data );
	}

	public function postCreateClient(){
		$rules = array(
			'title' => 'required',
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'dob' => 'required',
			'job_title' => 'required|min:3',
			'marital_status' => 'required',
			'partner_title' => 'required_if:marital_status,Married',
			'partner_first_name' => 'required_if:marital_status,Married|min:3',
			'partner_last_name' => 'required_if:marital_status,Married|min:3',
			'partner_dob' => 'required_if:marital_status,Married',
			'partner_job_title' => 'required_if:marital_status,Married|min:3',
		);
		$messages = array(
			'title.required'=>'Person Title is required',
			'first_name.required'=>'Person Name is required',
			'first_name.min'=>'Person Name must have more than 3 character',
			'last_name.required'=>'Person Last Name is required',
			'last_name.min'=>'Person Last Name must have more than 3 character',
			'dob.required'=>'Person Date of birth is required',
			'job_title.required'=>'Person Job Title is required',
			'job_title.min'=>'Person Job Title must have more than 3 character',
			'marital_status.required'=>'Person Marital Status is required',
			'partner_title.required_if'=>'Partner Title is required',
			'partner_first_name.required_if'=>'Partner Name is required',
			'partner_first_name.min'=>'Partner Name must have more than 3 character',
			'partner_last_name.required_if'=>'Partner Last Name is required',
			'partner_last_name.min'=>'Partner Last Name must have more than 3 character',
			'partner_dob.required_if'=>'Partner Date of birth is required',
			'partner_job_title.required_if'=>'Partner Title is required',
			'partner_job_title.min'=>'Partner Title Job Title must have more than 3 character',
		);
		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if ( $validator->passes() ) {
			\Input::merge(
				array(
					'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
					'ref' => \Auth::id().time(),
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
					'email' => '',
				)
			);

			\Input::merge(
				array(
					'type'=>1,
				)
			);

			$customer = \Clients\ClientEntity::get_instance()->createOrUpdate();

			//check if customer went in
			if( $customer->id ){
				// if Married add partner details
				if( \Input::get('marital_status') == 'Married' ) {
					\Input::merge(
						array(
							'type'=>1,
							'partner_dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('partner_dob')),
							'ref' => \Auth::id().time(),
							'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
							'belongs_user' => \Auth::id(),
							'title' => \Input::get('partner_title',''),
							'first_name' => \Input::get('partner_first_name',''),
							'last_name' => \Input::get('partner_last_name',''),
							'smoker' => \Input::get('partner_smoker',0),
							'job_title' => \Input::get('partner_job_title',''),
							'living_status' => \Input::get('partner_living_status',''),
							'employment_status' => \Input::get('partner_employment_status',''),
							'associated' => $customer->id,
							'relationship' => 'Spouse/Partner',
							'email' => '',
						)
					);
					$partner = \Clients\ClientEntity::get_instance()->createOrUpdate();
				}// if Married add partner details
				
				// insert address
				$address_checkbox = \Input::get('address_checkbox');
				foreach(\Input::get('address') as $address_type => $address_data) {
					if(in_array($address_type, $address_checkbox)) {
						$arrayAddress = array(
							'customer_id' 	 => $customer->id,
							'address_line_1' => $address_data['address_line_1'],
							'address_line_2' => $address_data['address_line_2'],
							'town' 			 => $address_data['town'],
							'county' 		 => $address_data['county'],
							'postcode' 		 => $address_data['postcode'],
							'type' 			 => ucfirst($address_type),
						);
						$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);
					}
				}

				// if has children then add
				if( count( \Input::get('children') ) > 0 ){
					foreach( \Input::get('children') as $key => $val ){
						if( trim($val['firstname']) != '' ){
							\Input::merge(
								array(
									'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate($val['dob']),
									'ref' => \Auth::id() . time() . rand(1,9),
									'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
//									'belongs_user' => \Auth::id(),
									'first_name' => $val['firstname'],
									'last_name' => $val['lastname'],
									'associated' => $customer->id,
									'relationship' => $val['relation_to_client'],
									'type' => 4,
									'email' => '',
								)
							);
							\Clients\ClientEntity::get_instance()->createOrUpdate();
						}
					}
				}// if has children then add

				// if has telephone then add
				$phone = \CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
					\Input::get('telephone'),
					$customer->id
				);
				// if has emails then add
				$email = \CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
					\Input::get('emails'),
					$customer->id
				);
				// if has url then add
				$url = \CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
					\Input::get('urls'),
					$customer->id
				);

                //custom fields
                if(\Input::has('custom_field')) {
                    \CustomFieldData\CustomFieldDataEntity::get_instance()->saveFieldData(\Input::get('custom_field'), $customer->id);
                }

				// update dashboard
				\Updates\UpdatesController::get_instance()->postUpdateWrapper(
					\User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					\Auth::id(),
					$customer->id,
					\Auth::user()->first_name.' '.\Auth::user()->last_name,
					'added a new personal client ',
					1
				);

				// Log Activity
				\Activity\ActivityEntity::get_instance()->logActivity('New Client', $customer->id);


				// update dashboard
			//	\Session::flash('message', 'Successfully Added Customer');
			//	return \Redirect::action('Clients\ClientsController@getIndex');
				//go to customer's page
				return \Redirect::to('clients/client-summary/'  . $customer->id);
			}//end customer id

		}else{
			\Input::flash();
			return \Redirect::action('Clients\ClientsController@getCreate')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getClientSummary($clientId){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data 											= $this->data_view;
		$data['pageTitle'] 					= 'Client';
		$data['contentClass'] 			= 'main-gutter-summary';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']			= 'Client';
		$data['fa_icons']						= 'user';
		$group_id										= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customer']						= \Clients\Clients::find($clientId);
		$data['customer']->touch();
		$data['currentClient']			= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['telephone']					= $data['customer']->telephone();
		$data['email']							= $data['customer']->emails();
		$data['url']								= $data['customer']->url();
		$data['profileImg']					= $data['customer']->profileImage();
		$data['belongToPartner']		= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']					= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']						= \Clients\ClientEntity::get_instance()->getCustomerPartner();
    	$data['customFields']       		= $data['customer']->customFieldsData();
		$data['center_column_view']			= 'dashboard';
		$data['customerId']					= $clientId;
		$data['clientId']						= $clientId;
		$data['belongsTo']					= \Auth::id();
		$data['tasks']							= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']			= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->limit(10)->orderBy('id','desc')->get();
		$data['files_count']				= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data['tags']								= \CustomerTags\CustomerTags::CustomerTag()->where('customer_id','=',$clientId)->get();

		//$data['tag_widget']			= \ClientTags\ClientTagsController::get_instance()->getClientTagWidget($clientId);
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['view_path'] . '.clients.summary', $data );
	}

	public function putClientUpdate($clientId){
		$rules = array(
			'title' => 'required',
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'dob' => 'required',
			'job_title' => 'required|min:3',
		);
		$messages = array(
			'title.required'=>'Person Title is required',
			'first_name.required'=>'Person Name is required',
			'first_name.min'=>'Person Name must have more than 3 character',
			'last_name.required'=>'Person Last Name is required',
			'last_name.min'=>'Person Last Name must have more than 3 character',
			'dob.required'=>'Person Date of birth is required',
			'job_title.required'=>'Person Job Title is required',
			'job_title.min'=>'Person Job Title must have more than 3 character',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			\Input::merge(
				array(
					'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
					'ref' => \Auth::id().time(),
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
				)
			);

			if( \Input::has('associated') ){
				\Input::merge(
					array(
						'type'=>1,
						'ref' => \Auth::id().time(),
						'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
						'belongs_user' => \Auth::id(),
						'title' => \Input::get('title'),
						'first_name' => \Input::get('first_name'),
						'last_name' => \Input::get('last_name'),
						'job_title' => \Input::get('job_title'),
						'living_status' => \Input::get('living_status'),
						'employment_status' => \Input::get('employment_status'),
						'associated' => \Input::get('associated'),
						'relationship' => 'Spouse/Partner',
						'email' => '',
					)
				);
			}
			//check if customer went in
			if( $clientId ){
				$customer = \Clients\ClientEntity::get_instance()->createOrUpdate($clientId);
				// if has telephone then update

				\CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
					\Input::get('telephone'),
					$clientId
				);
				// if has emails then add
				\CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
					\Input::get('emails'),
					$clientId
				);
				// if has url then add
				\CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
					\Input::get('urls'),
					$clientId
				);

				// if has children then add
				if( count( \Input::get('children') ) > 0 ){
					foreach( \Input::get('children') as $key => $val ){
						if( trim($val['firstname']) != '' ){
							\Input::merge(
								array(
									'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate($val['dob']),
									'ref' => \Auth::id() . time() . rand(1,9),
									'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
									'belongs_user' => \Auth::id(),
									'first_name' => $val['firstname'],
									'last_name' => $val['lastname'],
									'associated' => $customer->id,
									'relationship' => $val['relation_to_client'],
									'type' => 4,
									'email' => '',
								)
							);
							\Clients\ClientEntity::get_instance()->createOrUpdate();
						}
					}
				}				

				\CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
					\Input::get('edit_telephone'),
					$clientId
				);
				// if has emails then add
				\CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
					\Input::get('edit_emails'),
					$clientId
				);
				// if has url then add
				\CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
					\Input::get('edit_urls'),
					$clientId
				);

				// if has children then update
				if( count( \Input::get('edit_children') ) > 0 ){
					foreach( \Input::get('edit_children') as $key => $val ){
						if( trim($val['firstname']) != '' ){
							\Input::merge(
								array(
									'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate($val['dob']),
									//'ref' => \Auth::id() . time() . rand(1,9),
									//'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
									//'belongs_user' => \Auth::id(),
									'first_name' => $val['firstname'],
									'last_name' => $val['lastname'],
									'associated' => $customer->id,
									'relationship' => $val['relation_to_client'],
									'type' => 4,
									'email' => '',
								)
							);
							\Clients\ClientEntity::get_instance()->createOrUpdate($val['id']);
						}
					}
				}

				foreach(\Input::get('address') as $address_index => $address_data) {
					// check if new address
					if(isset($address_data['id'])) {
						if(in_array(strtolower($address_index), \Input::get('address_checkbox'))) {
							//update
							$arrayAddress = array(
								'address_line_1' => $address_data['address_line_1'],
								'address_line_2' => $address_data['address_line_2'],
								'town' 			 => $address_data['town'],
								'county' 		 => $address_data['county'],
								'postcode' 		 => $address_data['postcode'],
								//'type' 			 => $address_data[''],
							);
							$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress, $address_data['id']);							
						} else {
							//delete
							\CustomerAddress\CustomerAddress::find($address_data['id'])->delete();
						}
					} else {
						//create
						$arrayAddress = array(
							'customer_id' 	 => $clientId,
							'address_line_1' => $address_data['address_line_1'],
							'address_line_2' => $address_data['address_line_2'],
							'town' 			 => $address_data['town'],
							'county' 		 => $address_data['county'],
							'postcode' 		 => $address_data['postcode'],
							'type' 			 => ucfirst($address_index),
						);
						$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);						
					}
				}

				/*
				if( \Input::has('address_id') ){
					// update address
					$arrayAddress = array(
						'address_line_1' => \Input::get('address_line_1'),
						'address_line_2' => \Input::get('address_line_2'),
						'town' 			 => \Input::get('town'),
						'county' 		 => \Input::get('county'),
						'postcode' 		 => \Input::get('postcode'),
						'type' 			 => \Input::get('address_type'),
					);
					$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress, \Input::get('address_id'));
				}else{
					// insert address
					$arrayAddress = array(
						'customer_id' 	 => $clientId,
						'address_line_1' => \Input::get('address_line_1'),
						'address_line_2' => \Input::get('address_line_2'),
						'town' 			 => \Input::get('town'),
						'county' 		 => \Input::get('county'),
						'postcode' 		 => \Input::get('postcode'),
						'type' 			 => \Input::get('address_type'),
					);
					$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);
				}
				*/

                //custom fields
                if(\Input::has('custom_field')) {
                    \CustomFieldData\CustomFieldDataEntity::get_instance()->saveFieldData(\Input::get('custom_field'), $clientId);
                }


			}
			if( $customer ){

				// Log Activity
				\Activity\ActivityEntity::get_instance()->logActivity('Update Client', $clientId);

				\Session::flash('message', 'Successfully Updated Customer');
				return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$clientId));
			}
		}else{
			\Input::flash();
			return \Redirect::action('Clients\ClientsController@getEdit',array('clientId'=>$clientId))
			->withErrors($validator)
			->withInput();
		}
	}

	/**
	 * People
	 * */
	public function getPeople($clientId){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

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
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();
		$data['center_column_view']	= 'dashboard';
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data['customFields']       = $data['customer']->customFieldsData();
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['partner']->partner_id);
		//echo ($data['customer']->customerAssociatedTo($clientId)->get());
		//exit();
		return \View::make( $data['view_path'] . '.clients.people.people', $data );
	}

	public function getEmployee($clientId){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

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
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();
		$data['center_column_view']	= 'dashboard';
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['partner']);
		//var_dump($data['customer']->customerAssociatedTo($clientId)->get()->toArray());
		//exit();
		return \View::make( $data['view_path'] . '.clients.company.employee', $data );
	}

	/**
	 * End People
	 * */

	/**
	 * Company
	 * */

	public function getCreateClientCompany(){
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'create';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Add Company Client';
		$data['fa_icons']			= 'user';
		$data['title']				= $this->getTitleClient();
		$data['maritalStatus']		= $this->getMaritalStatus();
		$data['livingStatus']		= $this->getLivingStatus();
		$data['employmentStatus']	= $this->getEmploymentStatus();
		$data['phoneFor']			= $this->getPhoneFor();
		$data['emailFor']			= $this->getEmailFor();
		$data['relationToClient']	= $this->getRelationshipToClient();
		$data['addressType']		= $this->getAddressType();
		$data['websiteType']		= $this->getWebsiteFor();
		$data['websiteIs']			= $this->getWebsiteIs();

		$data 						= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		$data['center_column_view'] = 'dashboard';
		return \View::make( $data['view_path'] . '.clients.company.create', $data );
	}

	public function getEditCompany($clientId){
		$data 						= $this->data_view;
		$data['customer']			= \Clients\Clients::find($clientId);
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'create';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Update Company - ' . $data['customer']->company_name;
		$data['fa_icons']			= 'user';
		$data['title']				= $this->getTitleClient();
		$data['maritalStatus']		= $this->getMaritalStatus();
		$data['livingStatus']		= $this->getLivingStatus();
		$data['employmentStatus']	= $this->getEmploymentStatus();
		$data['phoneFor']			= $this->getPhoneFor();
		$data['emailFor']			= $this->getEmailFor();
		$data['relationToClient']	= $this->getRelationshipToClient();
		$data['addressType']		= $this->getAddressType();
		$data['websiteType']		= $this->getWebsiteFor();
		$data['websiteIs']			= $this->getWebsiteIs();
		$data['from']				= 'company';
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		$data['center_column_view'] = 'dashboard';
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['contactPerson']		= $data['customer']->customerAssociatedTo($clientId)->first();
		$data['telephone']			= $data['customer']->telephone();
		$data['email']				= $data['customer']->emails();
		$data['url']				= $data['customer']->url();
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data 						= array_merge($data,$this->getSetupThemes());

		/*var_dump($data['contactPerson']->get()->toArray());
		exit();*/
		return \View::make( $data['view_path'] . '.clients.company.edit', $data );
	}

	public function putUpdateClientCompany($clientId){
		$rules = array(
			'company_name' => 'required|min:3',
			'companyreg' => 'required|min:3',
			'companyemployee' => 'required',
			'sector' => 'required',
		);
		$messages = array(
			'company_name.required'=>'Company Name is required',
			'company_name.min'=>'Company Name must have more than 3 character',
			'companyreg.required'=>'Company Reg is required',
			'companyreg.min'=>'Company Reg must have more than 3 character',
			'companyemployee.required' => 'Company Employee is Required',
			'sector.required'=>'Sector is required',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if ( $validator->passes() ) {
			if( $clientId ){
				$company = \Clients\Clients::find($clientId);
				\Input::merge(
					array(
						'ref' => \Auth::id().time(),
						'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
						'belongs_user' => \Auth::id(),
						'email' => '',
						'company_name' => $company->company_name,
						'companyreg' => \Input::get('companyreg'),
						'companyemployee' => \Input::get('companyemployee'),
						'sector' => \Input::get('sector'),
						'duedil_company_details' => $company->duedil_company_details,
						'type' => '2',
					)
				);
				$customer = \Clients\ClientEntity::get_instance()->createOrUpdate($clientId);

				\CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
					\Input::get('telephone'),
					$clientId
				);
				// if has emails then add
				\CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
					\Input::get('emails'),
					$clientId
				);
				// if has url then add
				\CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
					\Input::get('urls'),
					$clientId
				);

				\CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
					\Input::get('edit_telephone'),
					$clientId
				);
				// if has emails then add
				\CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
					\Input::get('edit_emails'),
					$clientId
				);
				// if has url then add
				\CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
					\Input::get('edit_urls'),
					$clientId
				);

				// if has contact
				if( \Input::has('contact_person') ) {
					\Input::merge(
						array(
							'type'=>1,
							'ref' => \Auth::id().time(),
							'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
							'belongs_user' => \Auth::id(),
							'title' => \Input::get('title',''),
							'first_name' => \Input::get('first_name',''),
							'last_name' => \Input::get('last_name',''),
							'smoker' => \Input::get('partner_smoker',0),
							'job_title' => \Input::get('job_title',''),
							'associated' => $customer->id,
							'relationship' => 0,
							'organisation' => \Input::get('company',''),
							'email' => \Input::get('contact_email'),
							'telephone_day' => \Input::get('contact_phone')
						)
					);
					$contact = \Clients\ClientEntity::get_instance()->createOrUpdate(\Input::get('contact_person'));
				}// if has contact

                foreach(\Input::get('address') as $address_index => $address_data) {
                    // check if new address
                    if(isset($address_data['id'])) {
                        if(in_array(strtolower($address_index), \Input::get('address_checkbox'))) {
                            //update
                            $arrayAddress = array(
                                'address_line_1' => $address_data['address_line_1'],
                                'address_line_2' => $address_data['address_line_2'],
                                'town' 			 => $address_data['town'],
                                'county' 		 => $address_data['county'],
                                'postcode' 		 => $address_data['postcode'],
                                //'type' 			 => $address_data[''],
                            );
                            $address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress, $address_data['id']);
                        } else {
                            //delete
                            \CustomerAddress\CustomerAddress::find($address_data['id'])->delete();
                        }
                    } else {
                        //create
                        $arrayAddress = array(
                            'customer_id' 	 => $clientId,
                            'address_line_1' => $address_data['address_line_1'],
                            'address_line_2' => $address_data['address_line_2'],
                            'town' 			 => $address_data['town'],
                            'county' 		 => $address_data['county'],
                            'postcode' 		 => $address_data['postcode'],
                            'type' 			 => ucfirst($address_index),
                        );
                        $address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);
                    }
                }

//				if( \Input::has('address_id') ){
//					// update address
//					$arrayAddress = array(
//						'address_line_1' => \Input::get('address_line_1'),
//						'address_line_2' => \Input::get('address_line_2'),
//						'town' 			 => \Input::get('town'),
//						'county' 		 => \Input::get('county'),
//						'postcode' 		 => \Input::get('postcode'),
//						'type' 			 => \Input::get('address_type'),
//					);
//					$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress, \Input::get('address_id'));
//				}else{
//					// insert address
//					$arrayAddress = array(
//						'customer_id' 	 => $clientId,
//						'address_line_1' => \Input::get('address_line_1'),
//						'address_line_2' => \Input::get('address_line_2'),
//						'town' 			 => \Input::get('town'),
//						'county' 		 => \Input::get('county'),
//						'postcode' 		 => \Input::get('postcode'),
//						'type' 			 => \Input::get('address_type'),
//					);
//					$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);
//				}
			}
			\Session::flash('message', 'Successfully Updated Company');
			return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$clientId));
		}else{
			\Input::flash();
			return \Redirect::action('Clients\ClientsController@getEditCompany',array('clientId'=>$clientId))
			->withErrors($validator)
			->withInput();
		}

	}

	public function postCreateClientCompany(){
		$rules = array(
			'company_name' => 'required|min:3',
			'companyreg' => 'required|min:3',
			'companyemployee' => 'required',
			'sector' => 'required',
		);
		$messages = array(
			'company_name.required'=>'Company Name is required',
			'company_name.min'=>'Company Name must have more than 3 character',
			'companyreg.required'=>'Company Reg is required',
			'companyreg.min'=>'Company Reg must have more than 3 character',
			'companyemployee.required' => 'Company Employee is Required',
			'sector.required'=>'Sector is required',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if ( $validator->passes() ) {
			\Input::merge(
				array(
					'ref' => \Auth::id().time(),
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
					'email' => '',
					'company_name' => \Input::get('company_name'),
					'companyreg' => \Input::get('companyreg'),
					'companyemployee' => \Input::get('companyemployee'),
					'sector' => \Input::get('sector'),
					'duedil_company_details' => \Input::get('duedil_company'),
					'type' => '2',
				)
			);
			$customer = \Clients\ClientEntity::get_instance()->createOrUpdate();

			//check if customer went in
			if( $customer->id ){
				// if has contact
				if( \Input::has('first_name') ) {
					\Input::merge(
						array(
							'type'=>1,
							'ref' => \Auth::id().time(),
							'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
							'belongs_user' => \Auth::id(),
							'title' => \Input::get('title',''),
							'first_name' => \Input::get('first_name',''),
							'last_name' => \Input::get('last_name',''),
							'smoker' => \Input::get('partner_smoker',0),
							'job_title' => \Input::get('job_title',''),
							'associated' => $customer->id,
							'relationship' => 0,
							'organisation' => \Input::get('company',''),
							'email' => \Input::get('contact_email'),
							'telephone_day' => \Input::get('contact_phone')
						)
					);
					$contact = \Clients\ClientEntity::get_instance()->createOrUpdate();
				}// if has contact

				// insert address
//				$arrayAddress = array(
//					'customer_id' 	 => $customer->id,
//					'address_line_1' => \Input::get('address_line_1'),
//					'address_line_2' => \Input::get('address_line_2'),
//					'town' 			 => \Input::get('town'),
//					'county' 		 => \Input::get('county'),
//					'postcode' 		 => \Input::get('postcode'),
//					'type' 			 => \Input::get('address_type')
//				);
//				\CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);
                $address_checkbox = \Input::get('address_checkbox');
                foreach(\Input::get('address') as $address_type => $address_data) {
                    if(in_array($address_type, $address_checkbox)) {
                        $arrayAddress = array(
                            'customer_id' 	 => $customer->id,
                            'address_line_1' => $address_data['address_line_1'],
                            'address_line_2' => $address_data['address_line_2'],
                            'town' 			 => $address_data['town'],
                            'county' 		 => $address_data['county'],
                            'postcode' 		 => $address_data['postcode'],
                            'type' 			 => ucfirst($address_type),
                        );
                        $address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);
                    }
                }


				\CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
					\Input::get('telephone'),
					$customer->id
				);
				// if has emails then add
				\CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
					\Input::get('emails'),
					$customer->id
				);
				// if has url then add
				\CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
					\Input::get('urls'),
					$customer->id
				);

				// update dashboard
				\Updates\UpdatesController::get_instance()->postUpdateWrapper(
					\User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					\Auth::id(),
					$customer->id,
					\Auth::user()->first_name.' '.\Auth::user()->last_name,
					'added a new company client ',
					1
				);

				// Log Activity
				\Activity\ActivityEntity::get_instance()->logActivity('New Client', $customer->id);

				// update dashboard
				\Session::flash('message', 'Successfully Added Customer');
				return \Redirect::action('Clients\ClientsController@getIndex');

			}//end customer id

		}else{
			\Input::flash();
			return \Redirect::action('Clients\ClientsController@getCreateClientCompany')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getAddCompanyPerson($clientId){

		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data 						= $this->data_view;
		$data['title']				= $this->getTitleClient();
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
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();
		$data['peopleRelationship']	= $this->getPeopleRelationship();
		$data['phoneFor']			= $this->getPhoneFor();
		$data['emailFor']			= $this->getEmailFor();
		$data['addressType']		= $this->getAddressType();
		$data['websiteType']		= $this->getWebsiteFor();
		$data['websiteIs']			= $this->getWebsiteIs();
		$data['center_column_view']	= 'dashboard';
		$data['clientId']			= $clientId;
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data['customFields']       = $data['customer']->customFieldsData();
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['belongToPartner']);
		//exit();
		return \View::make( $data['view_path'] . '.clients.company.addPeople', $data );
	}


	public function postCompanyPerson(){
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'job_title' => 'required|min:3',
		);
		$messages = array(
			'first_name.required'=>'Person Name is required',
			'first_name.min'=>'Person Name must have more than 3 character',
			'last_name.required'=>'Person Last Name is required',
			'last_name.min'=>'Person Last Name must have more than 3 character',
			'job_title.required'=>'Person Job Title is required',
			'job_title.min'=>'Person Job Title must have more than 3 character',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if ( $validator->passes() ) {
			$company = \Clients\Clients::find( \Input::get('clientId') );
			\Input::merge(
				array(
					'type'=>1,
					'ref' => \Auth::id().time(),
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
					'first_name' => \Input::get('first_name'),
					'last_name' => \Input::get('last_name'),
					'smoker' => \Input::get('partner_smoker',0),
					'job_title' => \Input::get('job_title'),
					'associated' => \Input::get('clientId'),
					'organisation' => $company->company_name,
				)
			);
			$companyPerson = \Clients\ClientEntity::get_instance()->createOrUpdate();

			\CustomerPhone\CustomerPhoneController::get_instance()->iteratePhoneInput(
				\Input::get('telephone'),
				$companyPerson->id
			);
			// if has emails then add
			\CustomerEmail\CustomerEmailController::get_instance()->iterateEmailInput(
				\Input::get('emails'),
				$companyPerson->id
			);
			// if has url then add
			\CustomerURL\CustomerURLController::get_instance()->iterateURLInput(
				\Input::get('urls'),
				$companyPerson->id
			);

			// insert address
			$arrayAddress = array(
				'customer_id' 	 => $companyPerson->id,
				'address_line_1' => \Input::get('address_line_1'),
				'address_line_2' => \Input::get('address_line_2'),
				'town' 			 => \Input::get('town'),
				'county' 		 => \Input::get('county'),
				'postcode' 		 => \Input::get('postcode'),
				'type' 			 => \Input::get('address_type')
			);
			\CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);

			// update dashboard
			\Updates\UpdatesController::get_instance()->postUpdateWrapper(
				\User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
				\Auth::id(),
				\Input::get('clientId'),
				\Auth::user()->first_name.' '.\Auth::user()->last_name,
				'added a new person to a ' . $company->company_name,
				1
			);

			\Session::flash('message', 'Successfully Added Company Person');
			return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>\Input::get('clientId')));
		}else{
			\Input::flash();
			return \Redirect::action('Clients\ClientsController@getAddCompanyPerson',array('clientId'=>\Input::get('clientId')))
			->withErrors($validator)
			->withInput();
		}

	}

	public function getAjaxSearcCompanyInfo() {
		if( \Input::has('company_number') ){
			$number = \Input::get('company_number');
			$duedil_url = "http://api.duedil.com/open/uk/company/". urlencode($number) .".json?api_key=wtxqempevsm84r9tdc362v75";
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_URL => $duedil_url
			));
			// Send the request & save response to $resp
			$response = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);
			if ($response) {
				$json = json_decode($response, true);
				return \Response::json($json);
			} else {
				return false;
			}
		}
	}
	public function getAjaxSearchCompany(){
		if( \Input::has('company') ){
			$companyName = \Input::get('company');
			$duedil_url = "http://api.duedil.com/open/search?q=". urlencode($companyName) ."&api_key=wtxqempevsm84r9tdc362v75";
			// Get cURL resource
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_URL => $duedil_url
			));
			// Send the request & save response to $resp
			$response = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);

			if ($response) {
				$json = json_decode($response, true);
				$return = array();
				foreach($json['response']['data'] as $result) {
					$return[] = array('name'=> $result['name'], 'number' => $result['company_number']);
				}
				return json_encode($return);
				//return \Response::json($return);
			} else {
				return false;
			}
		}
	}

	/**
	 * End Company
	 * */

	/**
	 * Adding Family
	 * */
	public function getAddFamilyPerson($clientId){

		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data 						= $this->data_view;
		$data['title']				= $this->getTitleClient();
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
		$data['peopleRelationship']	= $this->getPeopleRelationship();
		$data['center_column_view']	= 'dashboard';
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['partner']->partner_id);
		//exit();
		return \View::make( $data['view_path'] . '.clients.people.addPeople', $data );
	}

	public function postFamilyPerson(){
		$rules = array(
			'title' => 'required',
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'dob' => 'required',
			'relationship' => 'required',
		);
		$messages = array(
			'title.required'=>'Person Title is required',
			'first_name.required'=>'Person Name is required',
			'first_name.min'=>'Person Name must have more than 3 character',
			'last_name.required'=>'Person Last Name is required',
			'last_name.min'=>'Person Last Name must have more than 3 character',
			'dob.required'=>'Person Date of birth is required',
			'relationship.required' => 'Person Relationship is required',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if ( $validator->passes() ) {
			if (\Input::get('relationship')=="Spouse/Partner") {
				\Input::merge(
					array(
						'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
						'ref' => \Auth::id() . time() . rand(1,9),
						'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
						'belongs_user' => \Auth::id(),
						'title' => \Input::get('title'),
						'first_name' => \Input::get('first_name'),
						'last_name' => \Input::get('last_name'),
						'associated' => \Input::get('clientId'),
						'relationship' => \Input::get('relationship'),
						'partner_title' => \Input::get('title'),
						'partner_first_name' => \Input::get('first_name'),
						'partner_last_name' => \Input::get('last_name'),
						'partner_dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
						'type' => 3,
					)
				);
			} else {
				\Input::merge(
					array(
						'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
						'ref' => \Auth::id() . time() . rand(1,9),
						'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
						'belongs_user' => \Auth::id(),
						'title' => \Input::get('title'),
						'first_name' => \Input::get('first_name'),
						'last_name' => \Input::get('last_name'),
						'associated' => \Input::get('clientId'),
						'relationship' => \Input::get('relationship'),
						'type' => 4,
					)
				);
			}
			\Clients\ClientEntity::get_instance()->createOrUpdate();
			//\Session::flash('message', 'Successfully Added Family Person');

			$data = array(
				'flag' => TRUE,
				'alert' => 'success',
				'message' => 'Successfully Added Family Person'
			);

			return \Response::json($data);

			//return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>\Input::get('clientId')));
		}else{
			\Input::flash();

			//return \Redirect::action('Clients\ClientsController@getAddFamilyPerson',array('clientId'=>\Input::get('clientId')))
			//->withErrors($validator)
			//->withInput();

			$data = array(
				'flag' => FALSE,
				'alert' => 'error',
				'message' => $validator->messages()
			);
			return \Response::json($data);
		}

	}

	public function getEditFamilyPerson($clientId){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data 						= $this->data_view;
		$data['title']				= $this->getTitleClient();
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
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();
		$data['peopleRelationship']	= $this->getPeopleRelationship();
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();
		$data['center_column_view']	= 'dashboard';
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['belongToPartner']);
		//exit();
		return \View::make( $data['view_path'] . '.clients.people.editPeople', $data );
	}

	public function putFamilyPerson($personId){
		$customer			= \Clients\Clients::find($personId);
		$belongToPartner	= \Clients\ClientEntity::get_instance()->getPartnerBelong($customer);

		if (\Input::get('relationship')=="Spouse/Partner") {
			\Input::merge(
				array(
					'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
					'ref' => \Auth::id() . time() . rand(1,9),
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
					'title' => \Input::get('title'),
					'first_name' => \Input::get('first_name'),
					'last_name' => \Input::get('last_name'),
					'associated' => $belongToPartner->id,
					'relationship' => \Input::get('relationship'),
					'partner_title' => \Input::get('title'),
					'partner_first_name' => \Input::get('first_name'),
					'partner_last_name' => \Input::get('last_name'),
					'partner_dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
					'type' => 3,
				)
			);
		} else {
			\Input::merge(
				array(
					'dob' => \Clients\ClientEntity::get_instance()->convertToMysqlDate(\Input::get('dob')),
					'ref' => \Auth::id() . time() . rand(1,9),
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
					'title' => \Input::get('title'),
					'first_name' => \Input::get('first_name'),
					'last_name' => \Input::get('last_name'),
					'associated' => $belongToPartner->id,
					'relationship' => \Input::get('relationship'),
					'type' => 4,
				)
			);
		}
		\Clients\ClientEntity::get_instance()->createOrUpdate($personId);
		\Session::flash('message', 'Successfully Updated - ' . \Input::get('first_name') . \Input::get('last_name') );
		return \Redirect::action('Clients\ClientsController@getEditFamilyPerson',array('personId'=>$personId));
	}


	/**
	 * End Adding Family
	 * */

	/**
	 * For Oppurtunities
	 * */
	public function getOpportunities($client_id) {

		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data = \CustomerOpportunities\CustomerOpportunitiesController::get_instance()->getOpportunities($client_id);

		$data1 = $this->_getClientData($client_id);

		$data['center_column_view']	= 'opportunities';

		$data 	= array_merge($data,$data1,$dashboard_data);

		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($client_id, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($client_id)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($client_id)->count();

		return \View::make( $data['view_path'] . '.clients.opportunities', $data );

	}

	public function postCreateOpportunities($client_id) {
		$data = \CustomerOpportunities\CustomerOpportunitiesController::get_instance()->postCreateOpportunities($client_id);
		return $data;
	}

	public function getDeleteOpportunities($id) {
		$data = \CustomerOpportunities\CustomerOpportunitiesController::get_instance()->getDelete($id);
		return $data;
	}

	public function getUpdateOpportunityStatus($id, $status) {
		$data = \CustomerOpportunities\CustomerOpportunitiesController::get_instance()->getUpdateStatus($id, $status);
		return $data;
	}
	/**
	 * For Oppurtunities
	 * */


	/**
	*
	* for import purposes
	**/
	public function getImportPerson(){
		//$data 					= $this->data_view;
		//$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.page';
		$data['page_view'] 		= $this->data_view['view_path'] . '.page';
		$data['pageTitle'] 		= 'Import';
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'import';
		$data['active']			= 'active';
		$data['portlet_title']	= 'Import';

		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.clients.import.index', $data );
	}

	public function postImportClientPerson(){
		$csv = \Clients\ImportClient::get_instance()->processImport();
		$data['csv']			= $csv;

		$data['page_view'] 		= $this->data_view['view_path'] . '.page';
		$data['pageTitle'] 		= 'Import';
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'import';
		$data['active']			= 'active';
		$data['portlet_title']	= 'Import';
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.clients.import.verify', $data );
	}

	public function postProcessImportClientPerson(){
		if( \Clients\ImportClient::get_instance()->processImportToDBperson() ){
			\Session::flash('message', 'Successfully Imported Clients' );
		}else{
			\Session::flash('message', 'Sorry something wrong in Importing clients' );
		}
		return \Redirect::action('Clients\ClientsController@getIndex');
	}

	/**
	*
	* for import purposes
	**/

	public function displayCreateTaskModal(){
		$data					 = $this->data_view;
		$modal['modalCallClass'] = \Task\TaskController::get_instance()->getModalCallClass();
		return \View::make( $data['view_path'] . '.clients.createTaskModal', $modal );
	}

	public function getTypeaheadClient(){
		$currentUserId 	= \Auth::id();
		$customer 		= \Clients\Clients::customerBelongsUser(\Auth::id());
		if( $customer->count() > 0 ){
			echo \Clients\ClientEntity::get_instance()->typeaheadJson($customer->get());
		}
	}

	public function getCreateClientTask($clientId = null, $redirect = null){
		\Input::merge(
			array('redirect'=>$redirect)
		);
		if( \Input::has('redirect') ){
			if( \Input::get('redirect') == 'client-summary' ){
				$redirect = url( 'clients/' . \Input::get('redirect') . '/' .$clientId );
			}else{
				$redirect = url( \Input::get('redirect') );
			}

		}else{
			$redirect = url('clients');
		}

		$data = array('clientid'=>$clientId,'redirect'=>$redirect);

		if( \Input::has('note_id') ) {
			$data['note_id'] = \Input::get('note_id');
		}

		return \Task\TaskController::get_instance()->getAjaxModalCreateTask($data);
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
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();

		return $data;
	}

	public function getCustom($clientId) {

		if(!\Input::get('custom'))
			return \Redirect::to('/');

		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data 						= $this->_getClientData($clientId);
		$data['center_column_view']	= 'custom-page';
		$data['customtab'] 			= \CustomFieldTab\CustomFieldTab::find(\Input::get('custom'));
		$data 						= array_merge($data,$dashboard_data);
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($clientId, \Auth::id());
		$data['customer_files']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->get();
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($clientId)->count();

		return \View::make( $data['view_path'] . '.clients.custom', $data );
	}

	public function getClientlist(){

		$clients = \DB::table('customer')
			->select('customer.id as customer_id', 'customer.first_name', 'customer.last_name')
			->leftJoin('customer_address', 'customer_address.customer_id', '=', 'customer.id')
			->leftJoin('customer_telephone', 'customer_telephone.customer_id', '=', 'customer.id')
			->where('customer.belongs_user', '=', \Auth::id())
			->whereNotIn('relationship',\Config::get('crm.client.relationship.exclude'))
			->where(function($query){
				$query->where('first_name','LIKE',\Input::get('keyword').'%')
					->orWhere('last_name','LIKE',\Input::get('keyword').'%')
					->orWhere('customer_telephone.number','LIKE','%'.trim(\Input::get('keyword'),urldecode("+")).'%')
					->orWhere('customer_address.postcode','LIKE',\Input::get('keyword').'%')
					->orWhere('company_name',\Input::get('keyword').'%');
			})
			->groupBy('customer.id')
			->get();
		
		return \Response::json( $clients );
	}

	public function getLiveDocuments($clientId)
	{
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

		$data 						= $this->_getClientData($clientId);
		$data['center_column_view']	= 'liveDocuments';
		$data['clientId']			= $clientId;

		$data['customer_details']		=  \Clients\Clients::find($clientId)->address()->first()->toArray();
		$data['vmd'] 				= \Clients\ClientEntity::get_instance()->getVMD();	//$this->client_model->getVMD();
		$account 					= \Clients\ClientEntity::get_instance()->getVMDAccount($clientId);	//$this->client_model->getVMDAccount($client);
		$data['account'] 			= $account;	
		$data['shared'] 			= \Clients\ClientEntity::get_instance()->getViewMyDocsSharedList($clientId);	//$this->client_model->getViewMyDocsSharedList($client);
		$data['uploaded'] 			= \Clients\ClientEntity::get_instance()->getViewMyDocsUploadedList($account['vmd']);	//$this->client_model->getViewMyDocsUploadedList($account['vmd']);		

		$data 						= array_merge($data,$dashboard_data);

		return \View::make( $data['view_path'] . '.clients.liveDocuments', $data);
	}

	public function getViewMyDocumentsActivate() {
		$clientID = \Input::get('id');
		$client = \Clients\Clients::find($clientID);
		// get client details so we can create an vmd account
		if ($client) {
			$result = \Clients\ClientEntity::get_instance()->createVMDAccount($client->id, $client->title, $client->first_name, $client->last_name, 'test@one23.co.uk', $client->address()->first()->postcode);
			
			if ($result) {
				// update client vmd record
				\Clients\ClientEntity::get_instance()->updateVMDRecord($client->id, $result['ref'], $result['pin']);
				return \Redirect::to('clients/live-documents/' . $client->id);
			} else {
				return \Redirect::to('clients/live-documents/' . $client->id . '?error');
			}
		}
	}

	public function getViewMyDocumentsUnlink() {
		//$this->load->model('client_model');
		//$client = $this->input->get('id');
		$client = \Input::get('id');
		//$this->client_model->updateVMDRecordRemove($client);
		\Clients\ClientEntity::get_instance()->updateVMDRecordRemove($client);
		//redirect("clients/view_my_documents?id=". $client);
		return \Redirect::to('clients/live-documents/' . $client);
	}		

	public function postViewMyDocumentsShare() {
		//$this->load->model('client_model');
		$name = \Input::get('name');	//$this->input->post('name');
		$file = \Input::get('file');	//$this->input->post('file');
		$client = \Input::get('client');	//$this->input->post('client');
		$notes = \Input::get('notes');	//$this->input->post('notes');
		$filename = \Input::get('filename');	//$this->input->post('filename');
		if ($filename) {
			// get vmd ref
			$vmd = \Clients\ClientEntity::get_instance()->getVMDAccount($client);	//$this->client_model->getVMDAccount($client);
			// upload file to vmd
			$upload = \Clients\ClientEntity::get_instance()->uploadVMDDocument($vmd, $filename, $name, $notes);	//$this->client_model->uploadVMDDocument($vmd, $filename, $name, $notes);
						
			if ($upload!="") {
				// save details
				$file_details = array(
					'url' => $upload['url'],
					'ref' => $upload['ref'],
					'time' => date('Y-m-d H:i:s'),
					'user_id' => $client,
					'name' => $name,
					'notes' => $notes
				);
				//$this->client_model->createVMDShared($file_details);
				\Clients\ClientEntity::get_instance()->createVMDShared($file_details);
				//redirect('clients/view_my_documents?id='.$client);			
				return \Redirect::to('clients/live-documents/' . $client);
			} else {
				//redirect('clients/view_my_documents?id='.$client . '&error');
				return \Redirect::to('clients/live-documents/' . $client . '?error');
			}
		} else {
			//redirect('clients');
			return \Redirect::to('clients');
		}	
	}

    public function getBulkDelete($token){

        if( strcmp(\Session::token(), $token) == 0 ){
            $client_ids = \Input::get('client_ids');

            foreach($client_ids as $id){
                $person = \Clients\Clients::find($id);
                if( $person->telephone()->count() > 0 ){
                    $person->telephone()->delete();
                }
                if( $person->address()->count() > 0 ){
                    $person->address()->delete();
                }
                if( $person->emails()->count() > 0 ){
                    $person->emails()->delete();
                }
                if( $person->url()->count() > 0 ){
                    $person->url()->delete();
                }
                if( $person->task()->count() > 0){
                    $person->task()->delete();
                }
                $person->delete();
            }
            // Log Activity
            //\Activity\ActivityEntity::get_instance()->logActivity('Remove Client', $id);

            \Session::flash('message', 'Successfully Deleted Client');
            return \Redirect::action('Clients\ClientsController@getIndex');
        }else{
            echo 'nice try hacker';
            die();
        }
    }

	public function getPopmail($client_id){
		$data = $this->data_view;
		$data['customer'] = \Clients\Clients::find($client_id);
		$data['customer']->touch();
		$data['currentClient'] = \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['email']				= $data['customer']->emails();
		return \View::make( $data['view_path'] . '.clients.partials.emailEmptyWidget', $data );
	}

}
