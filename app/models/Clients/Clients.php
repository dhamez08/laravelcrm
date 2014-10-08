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

	protected $fillable = array(
		'ref',
		'type',
		'belongs_to',
		'belongs_user',
		'first_name', 
		'last_name', 
		'title',
		'company_name',
	);

	public function address(){
		return $this->hasOne('\CustomerAddress\CustomerAddress','customer_id','id');
	}

	public function telephone(){
		return $this->hasMany('\CustomerTelephone\CustomerTelephone','customer_id','id');
	}

	public function emails(){
		return $this->hasMany('\CustomerEmail\CustomerEmail','customer_id','id');
	}

	public function url(){
		return $this->hasMany('\CustomerUrl\CustomerUrl','customer_id','id');
	}

	public function profileImage(){
		return $this->hasMany('\CustomerProfileImages\CustomerProfileImages','customer_id','id');
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

	/**
	 * Person that is associated to
	 * */
	public function scopeCustomerAssociatedTo($query, $associated){
		return $query->where('associated','=',$associated);
	}

}
