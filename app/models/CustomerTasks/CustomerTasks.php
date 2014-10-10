<?php
namespace CustomerTasks;
/**
 * main model for Clients
 * */

class CustomerTasks extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_tasks';

	public function scopeCustomerID($query,$customerID){
		return $query->where('customer_id', '=', $customerID);
	}

}
