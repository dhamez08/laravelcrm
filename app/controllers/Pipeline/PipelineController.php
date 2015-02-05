<?php

namespace Pipeline;

class PipelineController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $destination_path = null;
	protected $pipeline_model;

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
		$this->destination_path = "/public/document/library/own/";
		$this->data_view['pipeline_index'] 	= $this->data_view['view_path'] . '.pipeline.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
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
		return \Dashboard\DashboardController::get_instance()->getSetupThemes();
	}

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex(){
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Sales Pipeline';
		$data['portlet_title']		= 'Chart / Sales View';
		$data 						= array_merge($data,$this->getSetupThemes());

		$user = \Input::get('user');
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

		$months = array();
		$year = date('Y');
		foreach(range(1,12) as $monthNumber)
			$months[] = str_pad($monthNumber, 2, '0', STR_PAD_LEFT) . '/' . $year;
 
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
				//$data['forecast'] = $this->pipeline_model->pipelineForecastUser($users_list);
				$tempForecast = $this->pipeline_model->pipelineForecastUser($users_list);

				$forecast = array();
				foreach($months as $k => $m) {
					$forecast[$k] = new \stdClass;
					$forecast[$k]->thecash = '0.00';
					$forecast[$k]->maxcash = '0.00';
					$forecast[$k]->themonth = $m;
					foreach($tempForecast as $tf) {
						if($tf->themonth == $m) {
							$forecast[$k]->thecash = $tf->thecash;
							$forecast[$k]->maxcash = $tf->maxcash;
							$forecast[$k]->themonth = $tf->themonth;
						}
					}
				}

				$data['forecast'] = $forecast;
				\Debugbar::info($data['forecast']);

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

			} else {
				return \Redirect::to('pipeline');
			}
		} else {

			//$data['bymilestone'] = $this->pipeline_model->pipelineByMilestone();
			//$data['forecast'] = $this->pipeline_model->pipelineForecast();

			$tempForecast = $this->pipeline_model->pipelineForecast();

			$forecast = array();
			foreach($months as $k => $m) {
				$forecast[$k] = new \stdClass;
				$forecast[$k]->thecash = '0.00';
				$forecast[$k]->maxcash = '0.00';
				$forecast[$k]->themonth = $m;
				foreach($tempForecast as $tf) {
					if($tf->themonth == $m) {
						$forecast[$k]->thecash = $tf->thecash;
						$forecast[$k]->maxcash = $tf->maxcash;
						$forecast[$k]->themonth = $tf->themonth;
					}
				}
			}
			$data['forecast'] = $forecast;
			$data['stats'] = $this->pipeline_model->pipelineStats();

			
			$con_30 = $this->pipeline_model->pipelineConversion($month, $today);
			
			if ($con_30[0]->won!=0) {
				$cal_30 = ($con_30[0]->won/$con_30[0]->total*100);
			} else {
				$cal_30 = 0;
			}
			$data['conversion_30days'] = number_format($cal_30);
			$data['conversion_30days_count'] = $con_30[0]->total;

			// get data for the last 90 days
			$threemonths = date("Y-m-d", strtotime($todays_date ." -90 days")) . " 00:00:00";
			$con_90 = $this->pipeline_model->pipelineConversion($threemonths, $today);
			if ($con_90[0]->won!=0) {
				$cal_90 = ($con_90[0]->won/$con_90[0]->total*100);
			} else {
				$cal_90 = 0;
			}
			$data['conversion_90days'] = number_format($cal_90);
			$data['conversion_90days_count'] = $con_90[0]->total;

			$con_360 = $this->pipeline_model->pipelineConversion($days_360, $today);
			if ($con_360[0]->won!=0) {
				$cal_360 = ($con_360[0]->won/$con_360[0]->total*100);
			} else {
				$cal_360 = 0;
			}
			$data['conversion_360days'] = number_format($cal_360);
			$data['conversion_360days_count'] = $con_360[0]->total;

			$sales_30 = $this->pipeline_model->pipelineSales($first_day_month, $last_day_month);
			$data['sales_30days'] = $sales_30[0]->total;

			// get sales data from last 30 days
			$sales_90 = $this->pipeline_model->pipelineSales($threemonths, $today);
			$data['sales_90days'] = $sales_90[0]->total;

			// get sales data from last 30 days
			$sales_360 = $this->pipeline_model->pipelineSales($days_360, $today);
			$data['sales_360days'] = $sales_360[0]->total;
			$dates = array();
			for($i=1;$i<=$how_many_months;$i++) {
				$end_date->modify('+ 1 month');
				$dates[] = $start_date->format("Y-m-d H:i:s");
				$sales_for_month = $this->pipeline_model->pipelineSalesMonth($start_date->format("Y-m-d H:i:s"), $end_date->format("Y-m-d H:i:s"),$start_date->format("m/Y"));
				// add from the query into the array
				$chart_array[] = $sales_for_month;
				// add a month to the start date
				$start_date->modify('+ 1 month');
			}
			$data['sales_by_month'] = $chart_array;
			//dd($chart_array);

		}

		$data['group'] = $this->pipeline_model->getGroupUsersList();

		return \View::make( $data['view_path'] . '.pipeline.partials.chart-stats-view', $data );
	}

	public function getListView() {
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Sales Pipeline';
		$data['portlet_title']		= 'List View';
		$data 						= array_merge($data,$this->getSetupThemes());

		$status = \Input::get('status');
		$tag = \Input::get('tag');
		$user = \Input::get("user");
		$role = \Session::get("role");

		if ($role==1) {
			if (is_numeric($user)) {
				// check if user is part of this group
				if ($this->pipeline_model->getUserMemeberOfGroup($user)) {
					$data['group'] = $this->pipeline_model->getGroupUsersList();
					$data['list'] = $this->pipeline_model->pipelineListGroupUser($status, $tag, $user);
				} else {
					$data['list'] = "";
				}
			} elseif ($user=="all") {
				$users = $this->pipeline_model->getFullGroupUsersList();
				$data['group'] = $this->pipeline_model->getGroupUsersList();
				$data['list'] = $this->pipeline_model->pipelineListGroupUser($status, $tag, implode(',', $users));
			} else {
				$data['group'] = $this->pipeline_model->getGroupUsersList();
				$data['list'] =	$this->pipeline_model->pipelineList($status, $tag);
			}
		} else {
			$data['list'] =	$this->pipeline_model->pipelineList($status, $tag);
		}

		$data['selected_status'] = $status;
		$data['selected_tag'] = $tag;
		$data['opp_tags'] = $this->pipeline_model->getOpportunitiesTags();

		return \View::make( $data['view_path'] . '.pipeline.partials.list-view', $data );
	}

}
