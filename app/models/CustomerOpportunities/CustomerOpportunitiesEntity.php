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

	function pipelineForecast() {	
		$rows = array();
		$sql = "SELECT SUM(value_calc) as thecash, SUM(value) as maxcash, DATE_FORMAT(close_date,'%m/%Y') as themonth FROM customer_opportunities WHERE belongs_to=? AND status='0' GROUP BY themonth ORDER BY themonth";		
		$query = \DB::select($sql, array(\Auth::id()));	
		return $query;	
	}

	function pipelineStats() {
		$sql = "SELECT SUM(value_calc) as pipeline, SUM(value) as total FROM customer_opportunities WHERE belongs_to=? AND status='0'";		
		$query = \DB::select($sql, array(\Auth::id()));
		return $query;
		
	}

	function pipelineConversion($date_from, $date_to) {
		$sql = "SELECT COUNT(*) as total, COALESCE(sum(milestone='Won'), 0) as won FROM customer_opportunities WHERE belongs_to=? AND close_date>=? AND close_date<=?";		
		$query = \DB::select($sql, array(\Auth::id(),$date_from,$date_to));	
		return $query;
	
	}

	function pipelineSales($date_from, $date_to) {
		$sql = "SELECT SUM(value_calc) as total FROM customer_opportunities WHERE belongs_to=? AND close_date>=? AND close_date<=? AND milestone='Won'";		
		$query = \DB::select($sql, array(\Auth::id(),$date_from,$date_to));
						
		return $query;
			
	}

	function pipelineSalesMonth($date_from, $date_to, $month) {
		$sql = "SELECT IFNULL(SUM(value),0) as total, IFNULL(DATE_FORMAT(close_date,'%m/%Y'),?) as themonth FROM customer_opportunities WHERE belongs_to=? AND close_date>=? AND close_date<=? AND milestone='Won'";		
		
		$query = \DB::select($sql, array($month,\Auth::id(),$date_from,$date_to));
								
		return $query;	
			
	}

	function getGroupUsersList() {
		// $rows = array();
		// $sql = "SELECT users_to_groups.*, users.first_name, users.last_name, users.username FROM users_to_groups LEFT JOIN users ON users_to_groups.user_id=users.id WHERE users_to_groups.group_id='". $this->session->userdata("group_id") ."' AND user_id!='". $this->session->userdata("user_id") ."'";		
		// $query = $this->db->query($sql);		
		// if($query->num_rows() > 0) {
		// 	foreach($query->result_array() as $row) {
		// 		$rows[] = $row;
		// 	}
		// }		
		// return $rows;
	}

}
