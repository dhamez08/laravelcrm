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
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid page-full-width';
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
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
		$data['array_customer']		= \Clients\ClientEntity::get_instance()->getCustomerHead($group_id, $this->get_customer_type);
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
			\Session::flash('message', 'Successfully Delete Person');
			return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$client));
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
				$arrayAddress = array(
					'customer_id' 	 => $customer->id,
					'address_line_1' => \Input::get('address_line_1'),
					'address_line_2' => \Input::get('address_line_2'),
					'town' 			 => \Input::get('town'),
					'county' 		 => \Input::get('county'),
					'postcode' 		 => \Input::get('postcode'),
					'type' 			 => \Input::get('address_type'),
				);
				$address = \CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);

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

				// update dashboard
				\Updates\UpdatesController::get_instance()->postUpdateWrapper(
					\User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					\Auth::id(),
					$customer->id,
					\Auth::user()->first_name.' '.\Auth::user()->last_name,
					'added a new personal client ',
					1
				);

				// update dashboard
				\Session::flash('message', 'Successfully Added Customer');
				return \Redirect::action('Clients\ClientsController@getIndex');

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
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'main-gutter-summary';
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
		$data['center_column_view']	= 'dashboard';
		$data['customerId']			= $clientId;
		$data['clientId']			= $clientId;
		$data['belongsTo']			= \Auth::id();
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

                //custom fields
                if(\Input::has('custom_field')) {
                    \CustomFieldData\CustomFieldDataEntity::get_instance()->saveFieldData(\Input::get('custom_field'), $clientId);
                }


			}
			if( $customer ){
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
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

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
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['partner']->partner_id);
		//echo ($data['customer']->customerAssociatedTo($clientId)->get());
		//exit();
		return \View::make( $data['view_path'] . '.clients.people.people', $data );
	}

	public function getEmployee($clientId){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

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
				$arrayAddress = array(
					'customer_id' 	 => $customer->id,
					'address_line_1' => \Input::get('address_line_1'),
					'address_line_2' => \Input::get('address_line_2'),
					'town' 			 => \Input::get('town'),
					'county' 		 => \Input::get('county'),
					'postcode' 		 => \Input::get('postcode'),
					'type' 			 => \Input::get('address_type')
				);
				\CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($arrayAddress);

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
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

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
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

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
		$data['center_column_view']	= 'dashboard';
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
			\Session::flash('message', 'Successfully Added Family Person');
			return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>\Input::get('clientId')));
		}else{
			\Input::flash();
			return \Redirect::action('Clients\ClientsController@getAddFamilyPerson',array('clientId'=>\Input::get('clientId')))
			->withErrors($validator)
			->withInput();
		}

	}

	public function getEditFamilyPerson($clientId){
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

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
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

		$data = \CustomerOpportunities\CustomerOpportunitiesController::get_instance()->getOpportunities($client_id);

		$data1 = $this->_getClientData($client_id);

		$data['center_column_view']	= 'opportunities';

		$data 	= array_merge($data,$data1,$dashboard_data);

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

		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getCustomerTasks($clientId)
		->status(1)->with('label');

		return $data;
	}

	public function getCustom($clientId) {

		if(!\Input::get('custom'))
			return \Redirect::to('/');

		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

		$data 						= $this->_getClientData($clientId);
		$data['center_column_view']	= 'custom-page';
		$data['customtab'] 			= \CustomFieldTab\CustomFieldTab::find(\Input::get('custom'));
		$data 						= array_merge($data,$dashboard_data);

		return \View::make( $data['view_path'] . '.clients.custom', $data );
	}
}
