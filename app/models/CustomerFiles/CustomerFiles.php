<?php
namespace CustomerFiles;
/**
 * main model for Clients
 * */

class CustomerFiles extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_files';

	public function scopeFileType($query, $type){
		return $query->where('type','=',$type);
	}

	public function scopeCustomerFile($query, $customerId){
		return $query->where('customer_id','=',$customerId);
	}

}
