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
	
	protected $fillable = array(
		'customer_id',
		'address_line_1',
		'address_line_2',
		'town',
		'county',
		'postcode',
		'type',
	);

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
