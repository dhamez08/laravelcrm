<?php

namespace Clients;
/**
 * Clients Controller
 *
 * */

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
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		$this->data_view 					= parent::setupThemes();
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
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

	public function getOpportunityMilestones(){
		return $this->opportunity_milestones;
	}

	public function getOpportunityProbabilities(){
		return $this->opportunity_probabilities;
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
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client';
		$data['contentClass'] 	= '';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']		= 'user';
		$data 					= array_merge($data,$this->getSetupThemes());
		$data['center_column_view'] = 'dashboard';

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
		$data 						= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		$data['center_column_view'] = 'dashboard';
		return \View::make( $data['view_path'] . '.clients.create', $data );
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
		//unset(\Input::get('children'));
		var_dump( \Input::all() );
		echo '<br>======================<br>';
		\Input::merge(
			array(
				'dob' => \Clients\ClientEntity::get_instance()->convertDate(\Input::get('dob')),
				'ref' => \Auth::id().time(),
				'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
				'belongs_user' => \Auth::id(),
			)
		);
		var_dump( \Input::all() );
		echo \Clients\ClientEntity::get_instance()->createOrUpdate();
		/*if( count( \Input::get('children') ) > 0 ){
			foreach( \Input::get('children') as $key=>$val ){
			}
		}*/
	}

	public function getOpportunities($client_id) {
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client - Opportunities';
		$data['portlet_title'] 	= 'Client - Opportunities';
		$data['contentClass'] 	= '';
		$data['opportunities'] = \CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->getListsByLoggedUser();
		$data['client_id'] = $client_id;
		$data['milestones']		= $this->getOpportunityMilestones();
		$data['probabilities']	= $this->getOpportunityProbabilities();
		$data 					= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];
		return \View::make( $data['view_path'] . '.clients.opportunities', $data );
	}

	public function postCreateOpportunities($client_id) {
		$rules = array(
			'opportunity_name' => 'required|min:3',
			'opportunity_description' => 'required|min:3',
			'expected_value' => 'required|numeric',
			'milestone' => 'required|not_in:0',
			'probability' => 'required|not_in:0',
			'close_date' => 'required',
		);

		$messages = array(
			'opportunity_name.required' => 'Opportunity name is required.',
			'opportunity_name.min'=>'Opportunity name must have atleast 3 characters',
			'expected_value.required' => 'Expected is required.',
			'expected_value.number'=>'Expected value is not valid',
			'milestone.required' => 'Milestone is required.',
			'milestone.not_in' => 'Milestone is required.',
			'probability.required' => 'Probability is required.',
			'probability.not_in' => 'Probability is required.',
			'close_date.required' => 'Expected close date is required.',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			$value = \Input::get('expected_value');
			$probability = \Input::get('probability');
			if ($probability==100) {
				$value_calc = $value;
			} else {
				$value_calc = ($value*('.'.$probability));
			}

			$explode_date = explode('/', \Input::get('close_date'));
			$new_close_date = $explode_date['2'] . '-' . $explode_date['1'] . '-' . $explode_date['0'];

			\Input::merge(
				array(
					'belongs_to'=>\Auth::id(),
					'customer_id'=>$client_id,
					'value_calc'=>$value_calc,
					'close_date' => $new_close_date,
				)
			);
			
			// add to database
			if(\CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->createOrUpdate()) {
				\Session::flash('message', 'Opportunity was successfully created');
				return \Redirect::back();
			} else {
				return \Redirect::back()->withErrors(['There was a problem creating the opportunity, please try again']);
			}
		} else {
			\Input::flash();
			return \Redirect::back()
			->withErrors($validator)
			->withInput();
		}
	}

}
