<?php
namespace CustomerTelephone;
/**
 * main model for Clients
 * */

class CustomerTelephone extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_telephone';

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
