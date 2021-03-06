<?php
namespace CustomerUrl;
/**
 * main model for Clients
 * */

class CustomerUrl extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_url';

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
