<?php
namespace Clients;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class ClientEntity extends \Eloquent{

	protected $client_model;

	protected static $instance = null;

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
		$clients->type 						= \Input::get('type','');
		$clients->ref 						= \Input::get('ref','');
		$clients->belongs_to 				= \Input::get('belongs_to',0);
		$clients->belongs_user 				= \Input::get('belongs_user',0);
		$clients->title 					= \Input::get('title','');
		$clients->first_name 				= \Input::get('first_name','');
		$clients->last_name 				= \Input::get('last_name','');
		$clients->email 					= \Input::get('email','');
		$clients->address_id 				= \Input::get('address_id',0);
		$clients->gender 					= \Input::get('gender','');
		$clients->dob 						= \Input::get('dob');
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

	public function convertDate($value = 0, $dateFormat = 'Y-m-d'){
		if( $value != 0 ){
			return \Carbon\Carbon::parse( $value )->format($dateFormat);
		}else{
			return "0000-00-00";
		}
	}
}
