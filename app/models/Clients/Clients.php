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
		return $this->hasOne('\CustomerAddress\CustomerAddress','customer_id','id');
	}

	public function scopeClientId($query, $id){
		return $query->where('id','=',$id);
	}

	public function scopeCustomerType($query, $arrayType){
		return $query->whereIn('type',$arrayType);
	}

	public function scopeCustomerBelongsTo($query, $belongsTo){
		return $query->where('belongs_to','=',$belongsTo);
	}

}
