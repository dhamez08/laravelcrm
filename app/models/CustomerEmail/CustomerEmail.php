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

	protected $fillable = array(
		'customer_id',
		'email',
		'type',
	);

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
