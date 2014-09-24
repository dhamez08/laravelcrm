<?php
namespace CustomerEmail;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerEmailEntity extends \Eloquent{

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
			$clients = \Input::get('type','');
			$clients = \Input::get('ref','');
			$clients = \Input::get('belongs_to','');
			$clients = \Input::get('belongs_user','');
			$clients = \Input::get('added_date','');
			$clients = \Input::get('title','');
			$clients = \Input::get('first_name','');
			$clients = \Input::get('last_name','');
			$clients = \Input::get('email','');
			$clients = \Input::get('address_id','');
			$clients = \Input::get('gender','');
			$clients = \Input::get('dob','');
			$clients = \Input::get('smoker','');
			$clients = \Input::get('marital_status','');
			$clients = \Input::get('living_status','');
			$clients = \Input::get('employment_status','');
			$clients = \Input::get('occupation','');
			$clients = \Input::get('telephone_day','');
			$clients = \Input::get('telephone_evening','');
			$clients = \Input::get('telephone_mobile','');
			$clients = \Input::get('partner_title','');
			$clients = \Input::get('partner_first_name','');
			$clients = \Input::get('partner_last_name','');
			$clients = \Input::get('partner_dob','');
			$clients = \Input::get('partner_gender','');
			$clients = \Input::get('partner_employment','');
			$clients = \Input::get('partner_occupation','');
			$clients = \Input::get('company_name','');
			$clients = \Input::get('companyreg','');
			$clients = \Input::get('companyemployee','');
			$clients = \Input::get('sector','');
			$clients = \Input::get('background_info','');
			$clients = \Input::get('job_title','');
			$clients = \Input::get('organisation','');
			$clients = \Input::get('associated','');
			$clients = \Input::get('relationship','');
			$clients = \Input::get('profile_image','');
			$clients = \Input::get('duedil_company_details','');
			$clients = \Input::get('vmd','');
			$clients = \Input::get('vmd_pin','');
		}else{
			//update
			$clients = \Clients\Clients::find($id);
			$clients = \Input::get('type','');
			$clients = \Input::get('ref','');
			$clients = \Input::get('belongs_to','');
			$clients = \Input::get('belongs_user','');
			$clients = \Input::get('added_date','');
			$clients = \Input::get('title','');
			$clients = \Input::get('first_name','');
			$clients = \Input::get('last_name','');
			$clients = \Input::get('email','');
			$clients = \Input::get('address_id','');
			$clients = \Input::get('gender','');
			$clients = \Input::get('dob','');
			$clients = \Input::get('smoker','');
			$clients = \Input::get('marital_status','');
			$clients = \Input::get('living_status','');
			$clients = \Input::get('employment_status','');
			$clients = \Input::get('occupation','');
			$clients = \Input::get('telephone_day','');
			$clients = \Input::get('telephone_evening','');
			$clients = \Input::get('telephone_mobile','');
			$clients = \Input::get('partner_title','');
			$clients = \Input::get('partner_first_name','');
			$clients = \Input::get('partner_last_name','');
			$clients = \Input::get('partner_dob','');
			$clients = \Input::get('partner_gender','');
			$clients = \Input::get('partner_employment','');
			$clients = \Input::get('partner_occupation','');
			$clients = \Input::get('company_name','');
			$clients = \Input::get('companyreg','');
			$clients = \Input::get('companyemployee','');
			$clients = \Input::get('sector','');
			$clients = \Input::get('background_info','');
			$clients = \Input::get('job_title','');
			$clients = \Input::get('organisation','');
			$clients = \Input::get('associated','');
			$clients = \Input::get('relationship','');
			$clients = \Input::get('profile_image','');
			$clients = \Input::get('duedil_company_details','');
			$clients = \Input::get('vmd','');
			$clients = \Input::get('vmd_pin','');
		}
		$clients->save();
		return $clients;
	}

}
