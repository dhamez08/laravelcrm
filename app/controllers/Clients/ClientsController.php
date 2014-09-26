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
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['array_customer']		= \Clients\ClientEntity::get_instance()->getCustomerHead($group_id,$this->get_customer_type);
		$data['center_column_view'] = 'dashboard';
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.clients.index', $data );
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
		//$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customer']			= \Clients\Clients::find($clientId);
		//$data['currentClient']		= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
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
		\Input::merge(
			array(
				'dob' => \Clients\ClientEntity::get_instance()->convertDate(\Input::get('dob')),
				'ref' => \Auth::id().time(),
				'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
				'belongs_user' => \Auth::id(),
			)
		);
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
				array('type'=>1)
			);
			$customer = \Clients\ClientEntity::get_instance()->createOrUpdate();

			//check if customer went in
			if( $customer->id ){
				// if Married add partner details
				if( \Input::get('marital_status') == 'Married' ) {
					\Input::merge(
						array(
							'type'=>1,
							'dob' => \Clients\ClientEntity::get_instance()->convertDate(\Input::get('dob')),
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
						)
					);
					$partner = \Clients\ClientEntity::get_instance()->createOrUpdate();
				}// if Married add partner details
				\Input::merge(
					array('type'=>\Input::get('address_type'))
				);
				// insert address
				\CustomerAddress\CustomerAddressController::get_instance()->postAddressWrapper($customer->id);

				// if has children then add
				if( count( \Input::get('children') ) > 0 ){
					foreach( \Input::get('children') as $key => $val ){
						if( trim($val['firstname']) != '' ){
							\Input::merge(
								array(
									'dob' => \Clients\ClientEntity::get_instance()->convertDate($val['dob']),
									'ref' => \Auth::id() . time() . rand(1,9),
									'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
									'belongs_user' => \Auth::id(),
									'first_name' => $val['firstname'],
									'last_name' => $val['lastname'],
									'associated' => $customer->id,
									'relationship' => $val['relation_to_client'],
									'type' => 4,
								)
							);
							\Clients\ClientEntity::get_instance()->createOrUpdate();
						}
					}
				}// if has children then add

				// if has telephone then add
				if( count( \Input::get('telephone') ) > 0 ){
					foreach( \Input::get('telephone') as $key => $val ){
						if( trim($val['number']) != '' ){
							\CustomerPhone\CustomerPhoneController::get_instance()->postPhoneWrapper(
								$customer->id,
								$val['number'],
								$val['for']
							);
						}
					}
				}// if has telephone then add

				// if has emails then add
				if( count( \Input::get('emails') ) > 0 ){
					foreach( \Input::get('emails') as $key => $val ){
						if( trim($val['mail']) != '' ){
							\CustomerEmail\CustomerEmailController::get_instance()->postEmailWrapper(
								$customer->id,
								$val['mail'],
								$val['for']
							);
						}
					}
				}// if has emails then add

				// if has urls then add
				if( count( \Input::get('urls') ) > 0 ){
					foreach( \Input::get('urls') as $key => $val ){
						if( trim($val['url']) != '' ){
							\CustomerURL\CustomerURLController::get_instance()->postURLWrapper(
								$customer->id,
								$val['url'],
								$val['for'],
								$val['is']
							);
						}
					}
				}// if has urls then add

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
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customer']			= \Clients\Clients::find($clientId);
		$data['currentClient']		= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['center_column_view']	= 'dashboard';
		$data 						= array_merge($data,$dashboard_data);
		//var_dump($data['currentClient']);
		//exit();
		return \View::make( $data['view_path'] . '.clients.summary', $data );
	}

	public function putClientUpdate($clientId){
		\Input::merge(
			array(
				'dob' => \Clients\ClientEntity::get_instance()->convertDate(\Input::get('dob')),
				'ref' => \Auth::id().time(),
				'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
				'belongs_user' => \Auth::id(),
			)
		);
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
			$customer = \Clients\ClientEntity::get_instance()->createOrUpdate($clientId);
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
	 * For Oppurtunities
	 * */
	public function getOpportunities($client_id) {

		$data = \CustomerOpportunities\CustomerOpportunitiesController::get_instance()->getOpportunities($client_id);

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
	/**
	 * For Oppurtunities
	 * */
}
