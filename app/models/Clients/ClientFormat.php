<?php
namespace Clients;
/**
 * Class for binding data clients
 * */
use Illuminate\Support\Facades\Facade;
use Carbon\Carbon;
class ClientFormat extends Facade{

	protected $customer_data;

	public static function factory()
	{
		return new \Clients\ClientFormat;
	}

	/**
	 * Bind a Property taken from API to this object
	 */
	public function bind( $customer )
	{
		/*foreach( get_object_vars( $customer )  as $k => $v ){
			$this->$k = $v;
		}

		return $this;*/
		return $this->bindDetails($customer);
	}

	private function _processBind($data){
		foreach( get_object_vars( $data )  as $k => $v ){
			$this->$k = $v;
		}
		return $this;
	}

	public function bindDetails($customer){
		// this is for customer personal
		$array_customer = (object)$customer->toArray();
		// this is for customer address
		$array_address  = (object)$customer->address()->first()->toArray();
		// merge array and convert to object
		$obj_merged = (object)array_merge((array) $array_customer, (array) $array_address);
		// process bind
		return $this->_processBind($obj_merged);
	}

	/**
	 * will display customer name
	 * this is dependent on bind function
	 * @see bind
	 * @param	string	$title
	 * 	- default is true to display, else not display the title
	 * @return	string | customer name with title
	 * */
	public function displayCustomerName($title = true){
		if( $title ){
			$title = $this->title.' ';
		}else{
			$title = '';
		}
		return $title . $this->first_name . ' ' .$this->last_name;
	}

	/**
	 * will display customer spouse / partner name
	 * this is dependent on bind function
	 * @see bind
	 * @param	string	$title
	 * 	- default is true to display, else not display the title
	 * @return	string | customer name with title
	 * */
	public function displayCustomerPartnerName($title = true){
		if( $title ){
			$title = $this->partner_title.' ';
		}else{
			$title = '';
		}
		return $title . $this->partner_first_name . ' ' .$this->partner_last_name;
	}

	public function displayCustomerAddress($long = false){
		return $this->address_line_1 . ' ' .  $this->address_line_2 . ' ' .$this->town . ' ' .$this->county  . ( $long ? ' ' . $this->postcode:'');
	}

	public function displayGoogleMapLink(){
		return "http://maps.google.co.uk/maps?hl=en&safe=off&q=".$this->postcode;
	}

	public function displayGoogleMapDirectionLink(){
		return "http://maps.google.co.uk/maps?daddr=".$this->postcode;
	}

	public function displayDob($dateFormat = 'Y-m-d'){
		return \Carbon\Carbon::parse( $this->dob )->format($dateFormat);
	}

}
