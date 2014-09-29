<?php
namespace CustomerEmail;
/**
 * main model for Clients
 * */

class CustomerEmail extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_email';

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
