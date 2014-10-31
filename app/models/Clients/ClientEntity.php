<?php
namespace Clients;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class ClientEntity extends \Eloquent{

	protected $client_model;

	protected static $instance = null;

	protected $partner_data;

	protected $children_data;

	protected $array_not_included_data = array(
		'_token',
	);

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

	/**
	 * bind the customer and loop them
	 * @param	object	$object_data
	 * 	- this should be a object, if not please convert it first
	 * */
	public function bindCustomer($object_data){
		$binded_data = array();
		//single only
		if( count( $object_data ) == 1 ){
			$bind_data = new \Clients\ClientFormat;
			$binded_data = $bind_data->bind( $object_data );
		}else{
			// if its a array
		}
		return $binded_data;
	}

	public function _createOrUpdate($arrayData, $arrayNotIncluded = array(), $id = null){
		if( is_null($id) ) {
			//create
			$clients = new \Clients\Clients;
		}else{
			//update
			$clients = \Clients\Clients::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $data_key=>$data_val){
				if( !in_array($data_key,$arrayNotIncluded) ){
					$clients->$data_key = $data_val;
				}
			}
			$clients->save();
			return $clients;
		}
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
			$clients = new \Clients\Clients;
		}else{
			//update
			$clients = \Clients\Clients::find($id);
		}
		$clients->type 						= \Input::get('type','1');
		$clients->ref 						= \Input::get('ref');
		$clients->belongs_to 				= \Input::get('belongs_to');
		$clients->belongs_user 				= \Input::get('belongs_user');
		$clients->title 					= \Input::get('title','');
		$clients->first_name 				= \Input::get('first_name','');
		$clients->last_name 				= \Input::get('last_name','');
		$clients->email 					= \Input::get('email','');
		$clients->address_id 				= \Input::get('address_id',0);
		$clients->gender 					= \Input::get('gender','');
		$clients->dob 						= \Input::get('dob','0000-00-00');
		$clients->smoker 					= \Input::get('smoker',0);
		$clients->marital_status 			= \Input::get('marital_status','');
		$clients->living_status 			= \Input::get('living_status','');
		$clients->employment_status 		= \Input::get('employment_status','');
		$clients->occupation 				= \Input::get('occupation','');
		$clients->telephone_day 			= \Input::get('telephone_day','');
		$clients->telephone_evening 		= \Input::get('telephone_evening','');
		$clients->telephone_mobile 			= \Input::get('telephone_mobile','');
		$clients->partner_title 			= \Input::get('partner_title','');
		$clients->partner_first_name 		= \Input::get('partner_first_name','');
		$clients->partner_last_name 		= \Input::get('partner_last_name','');
		$clients->partner_dob 				= \Input::get('partner_dob','');
		$clients->partner_gender 			= \Input::get('partner_gender','');
		$clients->partner_employment 		= \Input::get('partner_employment','');
		$clients->partner_occupation 		= \Input::get('partner_occupation','');
		$clients->company_name 				= \Input::get('company_name','');
		$clients->companyreg 				= \Input::get('companyreg','');
		$clients->companyemployee 			= \Input::get('companyemployee','');
		$clients->sector 					= \Input::get('sector','');
		$clients->background_info 			= \Input::get('background_info','');
		$clients->job_title 				= \Input::get('job_title','');
		$clients->organisation 				= \Input::get('organisation','');
		$clients->associated				= \Input::get('associated','');
		$clients->relationship 				= \Input::get('relationship','');
		$clients->profile_image 			= \Input::get('profile_image','');
		$clients->duedil_company_details 	= \Input::get('duedil_company_details','');
		$clients->vmd						= \Input::get('vmd','');
		$clients->vmd_pin 					= \Input::get('vmd_pin','');

		$clients->save();
		return $clients;
	}

	public function convertDate($value = 0, $dateFormat = 'd/m/Y'){
		if( $value != 0 ){
			return \Carbon\Carbon::parse( $value )->format($dateFormat);
		}else{
			return "0000-00-00";
		}
	}

	public function convertToMysqlDate($dateValue){
		$date = \Carbon\Carbon::createFromFormat('d/m/Y',$dateValue);
		return $date->instance($date)->toDateString();
	}

	public function getCustomerList($belongsTo, $arrayType = array()){
		return \Clients\Clients::customerType($arrayType)->customerBelongsTo($belongsTo);
	}

	public function getCustomerAssociatedArray($clientId){
		$arrayCustomer = array();
		$dataCustomer = \Clients\Clients::customerAssociatedTo($clientId);
		if( $dataCustomer->count() > 0 ){
			foreach($dataCustomer->get() as $val){
				$arrayCustomer[$val->id]['customer_id'] = $val->id;
				$arrayCustomer[$val->id]['title'] = $val->title;
				$arrayCustomer[$val->id]['fullname'] = $val->title.' '.$val->first_name.' '.$val->last_name;
				$arrayCustomer[$val->id]['associated'] = $val->associated;
				$arrayCustomer[$val->id]['relationship'] = $val->relationship;
				$arrayCustomer[$val->id]['partner_dob'] = $val->partner_dob;
			}
			return $arrayCustomer;
		}
	}

	public function getCustomerHead($belongsTo, $arrayType = array()){
		$arrayCustomer = array();
		$dataCustomer = \Clients\Clients::customerType($arrayType)
		->customerBelongsTo($belongsTo)
		->with('myTag');
		if( $dataCustomer->count() > 0 ){
			foreach($dataCustomer->get() as $val){
				$arrayCustomer[$val->id]['customer_id'] = $val->id;
				$arrayCustomer[$val->id]['title'] = $val->title;
				$arrayCustomer[$val->id]['fullname'] = $val->title.' '.$val->first_name.' '.$val->last_name;
				$arrayCustomer[$val->id]['associated'] = $val->associated;
				$arrayCustomer[$val->id]['relationship'] = $val->relationship;
				$arrayCustomer[$val->id]['job_title'] = $val->job_title;
				$arrayCustomer[$val->id]['type'] = $val->type;
				$arrayCustomer[$val->id]['company_name'] = $val->company_name;
				$arrayCustomer[$val->id]['organisation'] = $val->organisation;
				$arrayCustomer[$val->id]['my_tag_object'] = $val->my_tag;
				$arrayCustomer[$val->id]['my_tag'] = $val->my_tag->lists('id');
			}
			return $arrayCustomer;
		}
	}

	public function setAssociateCustomer($customerId){
		$customer = \Clients\Clients::find($customerId);
		if( $customer->customerAssociatedTo($customer->id)->count() > 0 ){
			$children = 0;
			foreach( $customer->customerAssociatedTo($customer->id)->get() as $family ){
				if( $family->relationship == 'Spouse/Partner' ){
					$this->partner_data = array(
						'partner_id'=>$family->id,
						'partner_title'=>$family->partner_title,
						'partner_first_name'=>$family->partner_first_name,
						'partner_last_name'=>$family->partner_last_name,
						'partner_dob'=>$family->partner_dob,
						'partner_job_title'=>$family->job_title,
						'partner_living_status'=>$family->living_status,
						'partner_employment_status'=>$family->employment_status,
						'partner_smoker'=>$family->smoker,
						'relationship'=>$family->relationship,
					);
				}elseif( $family->type == 4 ){
					$this->children_data[] = (object)array(
						'children_id'=>$family->id,
						'first_name'=>$family->first_name,
						'last_name'=>$family->last_name,
						'dob'=>$family->dob,
						'relationship'=>$family->relationship,
					);
				}
			}
		}
	}

	public function getCustomerPartner(){
		return (object)$this->partner_data;
	}

	public function getCustomerChildren(){
		return $this->children_data;
	}

	public function getPartnerBelong($partnerBelong){
		if( $partnerBelong->associated != 0 ){
			return \Clients\Clients::clientId($partnerBelong->associated)->first();
		}else{
			return false;
		}
	}

	public function typeaheadJson($data){
		$typehead 	= array();
		foreach($data as $parse_key => $parse_val)
		{
			if($parse_val->type == 2){
				$typehead[] = array('id'=>$parse_val->id,'Name'=>$parse_val->company_name);
			}else{
				$typehead[] = array('id'=>$parse_val->id,'Name'=>$parse_val->first_name . $parse_val->last_name);
			}

		}
		return json_encode($typehead);
	}

}
