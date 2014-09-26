<?php
namespace CustomerAddress;
/**
 * main model for Clients
 * */

class CustomerAddress extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_address';

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
