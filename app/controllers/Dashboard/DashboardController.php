<?php
namespace Dashboard;
/**
 * This is for the dashboard controller
 * @author Allan
 * */

class DashboardController extends \BaseController {

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
		$this->data_view = parent::setupThemes();
		$this->data_view['dashboard_index'] = $this->data_view['view_path'] . '.dashboard.index';
		$this->pipeline_model = new \CustomerOpportunities\CustomerOpportunitiesEntity;
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
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid page-full-width';
		$this->data_view['header_class'] = 'page-header navbar navbar-fixed-top';
		return $this->data_view;
	}

	/**
	 * Index of the dashboard
	 * @return	View
	 * */
	public function getIndex(){
		$data = $this->getSetupThemes();

		$user = \Auth::id();
		$role = \Session::get('role');

		// set vars for the different things
		$todays_date = date("Y-m-d");
		$month = date("Y-m-01") . " 00:00:00";
		$today = date("Y-m-t") . " 23:59:59";
		$days_360 = date("Y"). "-01-01 00:00:00";
		$first_day_month = date("Y-m-01") . " 00:00:00";
		$last_day_month = date("Y-m-t") . " 23:59:59";
		$start_few_months_ago = new \DateTime(date("Y-m-01"));
		$start_few_months_ago->modify('- 3 months');
		$new_start_date = $start_few_months_ago->format("Y-m-d");
		$start_date = new \DateTime($new_start_date);
		$end_date = new \DateTime($start_date->format("Y-m-d"));
		$how_many_months = 8;
		$chart_array = array();
 
		if (is_numeric($user) || $user=="all") {
			if ($role==1) {

				if(is_numeric($user)) {
					if(!$this->pipeline_model->getUserMemeberOfGroup($user))
						return \Redirect::to('pipeline');

					$users_list = $user;
				} else {
					// get list of group users
					$users = $this->pipeline_model->getFullGroupUsersList();
					$users_list = implode(',', $users);
				}
				
				//$data['bymilestone'] = $this->pipeline_model->pipelineByMilestoneUser($user);
				$data['forecast'] = $this->pipeline_model->pipelineForecastUser($users_list);

				$data['stats'] = $this->pipeline_model->pipelineStatsUser($users_list);

				$con_30 = $this->pipeline_model->pipelineConversionUser($month, $today, $users_list);
				if ($con_30[0]->won!=0) {
					$cal_30 = ($con_30[0]->won/$con_30[0]->total*100);
				} else {
					$cal_30 = 0;
				}
				$data['conversion_30days'] = number_format($cal_30);
				$data['conversion_30days_count'] = $con_30[0]->total;

				// get data for the last 90 days
				$threemonths = date("Y-m-d", strtotime($todays_date ." -90 days")) . " 00:00:00";
				$con_90 = $this->pipeline_model->pipelineConversionUser($threemonths, $today, $users_list);
				if ($con_90[0]->won!=0) {
					$cal_90 = ($con_90[0]->won/$con_90[0]->total*100);
				} else {
					$cal_90 = 0;
				}
				$data['conversion_90days'] = number_format($cal_90);
				$data['conversion_90days_count'] = $con_90[0]->total;

				$con_360 = $this->pipeline_model->pipelineConversionUser($days_360, $today, $users_list);
				if ($con_360[0]->won!=0) {
					$cal_360 = ($con_360[0]->won/$con_360[0]->total*100);
				} else {
					$cal_360 = 0;
				}
				$data['conversion_360days'] = number_format($cal_360);
				$data['conversion_360days_count'] = $con_360[0]->total;

				$sales_30 = $this->pipeline_model->pipelineSalesUser($first_day_month, $last_day_month, $users_list);
				$data['sales_30days'] = $sales_30[0]->total;

				// get sales data from last 30 days
				$sales_90 = $this->pipeline_model->pipelineSalesUser($threemonths, $today, $users_list);
				$data['sales_90days'] = $sales_90[0]->total;

				// get sales data from last 30 days
				$sales_360 = $this->pipeline_model->pipelineSalesUser($days_360, $today, $users_list);
				$data['sales_360days'] = $sales_360[0]->total;

				for($i=1;$i<=$how_many_months;$i++) {
					$end_date->modify('+ 1 month');
					$sales_for_month = $this->pipeline_model->pipelineSalesMonthUser($start_date->format("Y-m-d H:i:s"), $end_date->format("Y-m-d H:i:s"),$start_date->format("m/Y"), $users_list);
					// add from the query into the array
					$chart_array[] = $sales_for_month;
					// add a month to the start date
					$start_date->modify('+ 1 month');
				}
				$data['sales_by_month'] = $chart_array;	
			}
		}

		return \View::make( $data['view_path'] . '.dashboard.index', $data );
	}

	/**
	 * display content dashboard
	 * @return View
	 * */
	public function displayContent(){
		$data = $this->data_view;
		return \View::make( $data['view_path'] . '.dashboard.partials.content', $data );
	}

}
