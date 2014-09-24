<?php
namespace CustomerEmployees;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerEmployeesEntity extends \Eloquent{
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
			$employees = new \CustomerEmployees\CustomerEmployees;
		}else{
			//update
			$employees = \CustomerEmployees\CustomerEmployees::find($id);
		}

		$employees->customer_id 		= \Input::get('customer_id');
		$employees->title 		= \Input::get('title');
		$employees->first_name 		= \Input::get('first_name');
		$employees->last_name 		= \Input::get('last_name');
		$employees->dob 		= \Input::get('dob');
		$employees->job_title 		= \Input::get('job_title');
		$employees->address 		= \Input::get('address');
		$employees->town 		= \Input::get('town');
		$employees->county 		= \Input::get('county');
		$employees->postcode 		= \Input::get('postcode');
		$employees->gender 		= \Input::get('gender');
		$employees->smoker 		= \Input::get('smoker');
		$employees->dob2 		= \Input::get('dob2');

		$employees->save();
		return $employees;
	}
}
