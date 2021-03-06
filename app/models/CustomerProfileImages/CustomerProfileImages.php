<?php
namespace CustomerProfileImages;
/**
 * main model for Clients
 * */

class CustomerProfileImages extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_profile_images';

	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
