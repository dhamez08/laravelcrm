<?php
namespace Clients;
/**
 * main model for Clients
 * */

class Clients extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer';

	public function address(){
		return $this->hasOne('\CustomerAddress\CustomerAddress','client_id','customer_id');
	}

	public function scopeCustomerType($query, $arrayType){
		return $query->whereIn('type',$arrayType);
	}

	public function scopeCustomerBelongsTo($query, $belongsTo){
		return $query->where('belongs_to','=',$belongsTo);
	}

}
