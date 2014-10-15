<?php
namespace CustomerOpportunities;
/**
 * Clients Controller
 *
 * */

class CustomerOpportunitiesController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Opportunity milestone
	 * */
	protected $opportunity_milestones;

	/**
	 * Opportunity probability
	 * */
	protected $opportunity_probabilities;

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
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
		$this->opportunity_milestones		= \Config::get('crm.opportunity_milestone');
		$this->opportunity_probabilities	= \Config::get('crm.opportunity_probability');
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

	
	public function getOpportunities($client_id) {

		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client - Opportunities';
		$data['portlet_title'] 	= 'Client - Opportunities';
		$data['contentClass'] 	= '';
		$data['opportunities'] 	= \CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->getListsByCustomer($client_id);
		//$data['opportunities'] 	= \CustomerOpportunities\CustomerOpportunitiesEntity::with('tags.tag')->get();
		$data['opp_tags'] 		= \OpportunityTag\OpportunityTagEntity::get_instance()->getTagsByLoggedUser();
		$data['client_id'] 		= $client_id;
		$data['milestones']		= $this->getOpportunityMilestones();
		$data['probabilities']	= $this->getOpportunityProbabilities();
		$data 					= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] 	= $this->data_view['html_body_class'];

		return $data;
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
			$opp = \CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->createOrUpdate(\Input::get('id')<>'' ? \Input::get('id'):null);
			if($opp) {
				//check if tag exists
				if(\Input::get('tag')) {
					//delete existing tag
					\CustomerOpportunitiesTags\CustomerOpportunitiesTagsEntity::get_instance()->where('opp_id','=',$opp->id)->delete();
					foreach(\Input::get('tag') as $tag) {
						\Input::merge(
							array(
								'opp_id'=>$opp->id,
								'opp_tag'=>$tag
							)
						);
						$opp_tag = \CustomerOpportunitiesTags\CustomerOpportunitiesTagsEntity::get_instance()->createOrUpdate();
					}
				}

				\Session::flash('message', 'Opportunity was successfully saved');
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

	public function getDelete($id) {
		$opportunity = \CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->find($id);
		if($opportunity) {
			$opportunity->delete();
			\Session::flash('message', 'Opportunity was successfully deleted');
			return \Redirect::back();
		} else {
			return \Redirect::back()->withErrors(['There was a problem deleting the opportunity, please try again']);
		}
	}

	public function getUpdateStatus($id, $status) {
		$opportunity = \CustomerOpportunities\CustomerOpportunitiesEntity::get_instance()->find($id);
		if($opportunity) {
			$opportunity->status = $status;
			$opportunity->save();
			\Session::flash('message', 'Opportunity status was successfully saved');
			return \Redirect::back();
		} else {
			return \Redirect::back()->withErrors(['There was a problem updating the opportunity, please try again']);
		}
	}

}
