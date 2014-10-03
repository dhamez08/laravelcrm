<?php
namespace CustomerOpportunities;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerOpportunitiesEntity extends \Eloquent{

	protected static $instance = null;

	protected $table = 'customer_opportunities';

	public function __construct(){

	}

	/**
	 * Return an instance of this class.
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

	public function tags() {
		return $this->hasMany('CustomerOpportunitiesTags\CustomerOpportunitiesTagsEntity','opp_id');
	}

	/**
	 * This is use to create user or update
	 * this is full field, mainly use in register
	 *
	 * @param 	$id		int		default null		if there is id then update, else create
	 * @param	$active	int		default 2			#2 means not active
	 * 												#1 would be active
	 * @return db last insert id
	 * */
	public function createOrUpdate($id = null){
		if( is_null($id) ) {
			//create
			$obj = new \CustomerOpportunities\CustomerOpportunities;
		}else{
			//update
			$obj = \CustomerOpportunities\CustomerOpportunities::find($id);
		}
		$obj->customer_id = \Input::get('customer_id',\Auth::id());
		$obj->belongs_to = \Input::get('belongs_to',0);
		$obj->belongs_user = \Input::get('belongs_user',0);
		$obj->milestone = \Input::get('milestone','');
		$obj->probability = \Input::get('probability','');
		$obj->value = \Input::get('expected_value','');
		$obj->value_calc = \Input::get('value_calc','');
		$obj->close_date = \Input::get('close_date','');
		$obj->name = \Input::get('opportunity_name','');
		$obj->text = \Input::get('opportunity_description','');
		$obj->status = \Input::get('status','');
		return $obj->save() ? $obj:0;
	}

	public function getListsByLoggedUser() {
		//$obj = new \CustomerOpportunities\CustomerOpportunities;
		return $this->with('tags')->where('belongs_to','=',\Auth::id())->get();
	}

	public function pipelineForecast() {	
		$rows = array();
		$sql = "SELECT SUM(value_calc) as thecash, SUM(value) as maxcash, DATE_FORMAT(close_date,'%m/%Y') as themonth FROM customer_opportunities WHERE belongs_to=? AND status='0' AND deleted_at IS NULL GROUP BY themonth ORDER BY close_date";		
		$query = \DB::select($sql, array(\Auth::id()));	
		return $query;	
	}

	public function pipelineStats() {
		$sql = "SELECT SUM(value_calc) as pipeline, SUM(value) as total FROM customer_opportunities WHERE belongs_to=? AND status='0' AND deleted_at IS NULL";		
		$query = \DB::select($sql, array(\Auth::id()));
		return $query;
		
	}

	public function pipelineConversion($date_from, $date_to) {
		$sql = "SELECT COUNT(*) as total, COALESCE(sum(milestone='Won'), 0) as won FROM customer_opportunities WHERE belongs_to=? AND close_date>=? AND close_date<=? AND deleted_at IS NULL";		
		$query = \DB::select($sql, array(\Auth::id(),$date_from,$date_to));	
		return $query;
	
	}

	public function pipelineSales($date_from, $date_to) {
		$sql = "SELECT SUM(value_calc) as total FROM customer_opportunities WHERE belongs_to=? AND close_date>=? AND close_date<=? AND milestone='Won' AND deleted_at IS NULL";		
		$query = \DB::select($sql, array(\Auth::id(),$date_from,$date_to));
						
		return $query;
			
	}

	public function pipelineSalesMonth($date_from, $date_to, $month) {
		$sql = "SELECT IFNULL(SUM(value),0) as total, IFNULL(DATE_FORMAT(close_date,'%m/%Y'),?) as themonth FROM customer_opportunities WHERE belongs_to=? AND close_date>=? AND close_date<=? AND milestone='Won' AND deleted_at IS NULL";		
		
		$query = \DB::select($sql, array($month,\Auth::id(),$date_from,$date_to));
								
		return $query;	
			
	}

	public function getGroupUsersList() {
		$sql = "SELECT users_to_groups.*, users.first_name, users.last_name, users.username FROM users_to_groups LEFT JOIN users ON users_to_groups.user_id=users.id WHERE users_to_groups.group_id=? AND user_id!=? AND users.deleted_at IS NULL AND users_to_groups.deleted_at IS NULL";		
		$query = \DB::select($sql, array(\Session::get('group_id'),\Auth::id()));		
		
		return $query;
	}

	public function getFullGroupUsersList() {
		$rows = array();
		$sql = "SELECT user_id FROM users_to_groups WHERE group_id=? AND deleted_at IS NULL";		
		$query = \DB::select($sql, array(\Session::get('group_id')));		
		if(count($query) > 0) {
			foreach($query as $row) {
				$rows[] = $row->user_id;
			}
		}		
		return $rows;
	}

	public function pipelineForecastUser($users) {	
	
		$sql = "SELECT SUM(value_calc) as thecash, SUM(value) as maxcash, DATE_FORMAT(close_date,'%m/%Y') as themonth FROM customer_opportunities WHERE belongs_to IN (?) AND status='0' AND deleted_at IS NULL GROUP BY themonth ORDER BY close_date";		
		$query = \DB::select($sql, array($users));		
	
		return $query;	
	}

	public function pipelineStatsUser($users) {
		$sql = "SELECT SUM(value_calc) as pipeline, SUM(value) as total FROM customer_opportunities WHERE belongs_to IN (?) AND status='0' AND deleted_at IS NULL";		
		$query = \DB::select($sql, array($users));
				
		return $query;
	}

	public function pipelineConversionUser($date_from, $date_to, $users) {
		$sql = "SELECT COUNT(*) as total, COALESCE(sum(milestone='Won'), 0) as won FROM customer_opportunities WHERE belongs_to IN (?) AND close_date>=? AND close_date<=? AND deleted_at IS NULL";		
		$query = \DB::select($sql, array($users, $date_from, $date_to));
				
		return $query;
	}

	public function pipelineSalesUser($date_from, $date_to, $users) {
		$sql = "SELECT SUM(value_calc) as total FROM customer_opportunities WHERE belongs_to IN (?) AND close_date>=? AND close_date<=? AND milestone='Won' AND deleted_at IS NULL";		
		$query = \DB::select($sql, array($users, $date_from, $date_to));
						
		return $query;	
			
	}

	public function pipelineSalesMonthUser($date_from, $date_to, $month, $users) {
		$sql = "SELECT IFNULL(SUM(value),0) as total, IFNULL(DATE_FORMAT(close_date,'%m/%Y'),?) as themonth FROM customer_opportunities WHERE belongs_to IN (?) AND close_date>=? AND close_date<=? AND milestone='Won' AND deleted_at IS NULL";		
		
		$query = \DB::select($sql, array($month,$users,$date_from,$date_to));
								
		return $query;	
			
	}

	public function getUserMemeberOfGroup($user) {
		$sql = "SELECT * FROM users_to_groups WHERE group_id=? AND user_id=? AND deleted_at IS NULL LIMIT 1";
		$query = \DB::select($sql, array(\Session::get('group_id'), $user));		
		if(count($query) > 0) {
			return true;
		} else {
			return false;
		}
	}

	function getOpportunitiesTags() {
		$sql = "SELECT * FROM tags_opportunities WHERE belongs_to=? ORDER BY tag ASC";
		$query = \DB::select($sql, array(\Auth::id()));
		return $query;
	}

	public function pipelineList($status, $tag) {
		$rows = array();
		$sql = "SELECT customer_opportunities.*, CONCAT(customer.company_name, ' ', customer.first_name, ' ', customer.last_name) as client FROM customer_opportunities LEFT JOIN customer on customer_opportunities.customer_id=customer.id";
		if ($tag!="") {		
		$sql .= " LEFT JOIN customer_opportunities_tags on customer_opportunities_tags.opp_id=customer_opportunities.id";
		}		
		$sql .= " WHERE customer_opportunities.belongs_to=? ";
		// todays date
		$todays_is = date("Y-m-d H:i:s");	
		if ($status=="open") {
			$sql .=" AND customer_opportunities.status='0' ";
		} elseif ($status=="closed") {
			$sql .=" AND customer_opportunities.status='1' ";
		} elseif ($status=="closed30") {
			$todate = date("Y-m-d H:i:s", strtotime($todays_is . " -30 days"));
			$sql .=" AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".$todate."' AND customer_opportunities.close_date<='".$todays_is."' ";
		} elseif ($status=="closed90") {
			$todate = date("Y-m-d H:i:s", strtotime($todays_is . " -90 days"));
			$sql .=" AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".$todate."' AND customer_opportunities.close_date<='".$todays_is."' ";
		} elseif ($status=="closedyear") {
			$todate = date("Y-m-d H:i:s", strtotime($todays_is . " -1 year"));
			$sql .=" AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".$todate."' AND customer_opportunities.close_date<='".$todays_is."' ";
		} elseif ($status=="suspect") {
			$sql .=" AND customer_opportunities.milestone='Suspect' ";
		} elseif ($status=="prospect") {
			$sql .=" AND customer_opportunities.milestone='Prospect' ";
		} elseif ($status=="champion") {
			$sql .=" AND customer_opportunities.milestone='Champion' ";
		} elseif ($status=="opportunity") {
			$sql .=" AND customer_opportunities.milestone='Opportunity' ";
		} elseif ($status=="proposal") {
			$sql .=" AND customer_opportunities.milestone='Proposal' ";
		} elseif ($status=="verbal") {
			$sql .=" AND customer_opportunities.milestone='Verbal' ";
		} elseif ($status=="lost") {
			$sql .=" AND customer_opportunities.milestone='Lost' ";
		} elseif ($status=="won") {
			$sql .=" AND customer_opportunities.milestone='Won' ";					
		} elseif ($status=="wonthismonth") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y-m")."-01 00:00:00' AND customer_opportunities.close_date<='".date("Y-m-t"). " 23:59:59' ";	
		} elseif ($status=="won90days") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='". date("Y-m-d H:i:s", strtotime($todays_is . " -90 days")) ."' AND customer_opportunities.close_date<='". $todays_is ."' ";		
		} elseif ($status=="wonthisyear") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y")."-01-01 00:00:00' AND customer_opportunities.close_date<='".date("Y")."-12-31 23:59:59' ";
		} elseif ($status=="conversionthismonth") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y-m")."-01 00:00:00' AND customer_opportunities.close_date<='".date("Y-m-t"). " 23:59:59' ";	
		} elseif ($status=="conversion90days") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='". date("Y-m-d H:i:s", strtotime($todays_is . " -90 days")) ."' AND customer_opportunities.close_date<='". $todays_is ."' ";		
		} elseif ($status=="conversionthisyear") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y")."-01-01 00:00:00' AND customer_opportunities.close_date<='".date("Y")."-12-31 23:59:59' ";
		}	
		
		if ($tag!="") {
			$sql .= "AND customer_opportunities_tags.opp_tag=? ";
		}
		
		$sql .= "ORDER BY customer_opportunities.close_date DESC";
		if($tag!="")
			$query = \DB::select($sql, array(\Auth::id(),$tag));
		else
			$query = \DB::select($sql, array(\Auth::id()));
		return $query;	
	}

	public function pipelineListGroupUser($status, $tag, $user) {
		$rows = array();
		$sql = "SELECT customer_opportunities.*, CONCAT(customer.company_name, ' ', customer.first_name, ' ', customer.last_name) as client FROM customer_opportunities LEFT JOIN customer on customer_opportunities.customer_id=customer.id";
		if ($tag!="") {		
		$sql .= " LEFT JOIN customer_opportunities_tags on customer_opportunities_tags.opp_id=customer_opportunities.id";
		}		
		$sql .= " WHERE customer_opportunities.belongs_to IN (?) ";
		// todays date
		$todays_is = date("Y-m-d H:i:s");	
		if ($status=="open") {
			$sql .=" AND customer_opportunities.status='0' ";
		} elseif ($status=="closed") {
			$sql .=" AND customer_opportunities.status='1' ";
		} elseif ($status=="closed30") {
			$todate = date("Y-m-d H:i:s", strtotime($todays_is . " -30 days"));
			$sql .=" AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".$todate."' AND customer_opportunities.close_date<='".$todays_is."' ";
		} elseif ($status=="closed90") {
			$todate = date("Y-m-d H:i:s", strtotime($todays_is . " -90 days"));
			$sql .=" AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".$todate."' AND customer_opportunities.close_date<='".$todays_is."' ";
		} elseif ($status=="closedyear") {
			$todate = date("Y-m-d H:i:s", strtotime($todays_is . " -1 year"));
			$sql .=" AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".$todate."' AND customer_opportunities.close_date<='".$todays_is."' ";
		} elseif ($status=="suspect") {
			$sql .=" AND customer_opportunities.milestone='Suspect' ";
		} elseif ($status=="prospect") {
			$sql .=" AND customer_opportunities.milestone='Prospect' ";
		} elseif ($status=="champion") {
			$sql .=" AND customer_opportunities.milestone='Champion' ";
		} elseif ($status=="opportunity") {
			$sql .=" AND customer_opportunities.milestone='Opportunity' ";
		} elseif ($status=="proposal") {
			$sql .=" AND customer_opportunities.milestone='Proposal' ";
		} elseif ($status=="verbal") {
			$sql .=" AND customer_opportunities.milestone='Verbal' ";
		} elseif ($status=="lost") {
			$sql .=" AND customer_opportunities.milestone='Lost' ";
		} elseif ($status=="won") {
			$sql .=" AND customer_opportunities.milestone='Won' ";					
		} elseif ($status=="wonthismonth") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y-m")."-01 00:00:00' AND customer_opportunities.close_date<='".date("Y-m-t"). " 23:59:59' ";	
		} elseif ($status=="won90days") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='". date("Y-m-d H:i:s", strtotime($todays_is . " -90 days")) ."' AND customer_opportunities.close_date<='". $todays_is ."' ";		
		} elseif ($status=="wonthisyear") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y")."-01-01 00:00:00' AND customer_opportunities.close_date<='".date("Y")."-12-31 23:59:59' ";
		} elseif ($status=="conversionthismonth") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y-m")."-01 00:00:00' AND customer_opportunities.close_date<='".date("Y-m-t"). " 23:59:59' ";	
		} elseif ($status=="conversion90days") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='". date("Y-m-d H:i:s", strtotime($todays_is . " -90 days")) ."' AND customer_opportunities.close_date<='". $todays_is ."' ";		
		} elseif ($status=="conversionthisyear") {
			$sql .=" AND customer_opportunities.milestone='Won' AND customer_opportunities.status='1' AND customer_opportunities.close_date>='".date("Y")."-01-01 00:00:00' AND customer_opportunities.close_date<='".date("Y")."-12-31 23:59:59' ";
		}	
		
		if ($tag!="") {
			$sql .= "AND customer_opportunities_tags.opp_tag=? ";
		}
		
		$sql .= "ORDER BY customer_opportunities.close_date DESC";

		if($tag!="")
			$query = \DB::select($sql, array(\Auth::id(),$tag));
		else
			$query = \DB::select($sql, array(\Auth::id()));

		return $query;	
	}

}
