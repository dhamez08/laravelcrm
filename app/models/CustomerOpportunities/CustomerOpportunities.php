<?php
namespace CustomerOpportunities;
/**
 * main model for Clients
 * */

class CustomerOpportunities extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_opportunities';

	public function customer() {
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

}
