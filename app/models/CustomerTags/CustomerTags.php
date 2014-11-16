<?php
namespace CustomerTags;
/**
 * main model for Clients
 * */

class CustomerTags extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_tags';

	public function tags(){
		return $this->belongsTo('\ClientTag\ClientTag','tag_id','id');
	}

	public function customer(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

	public function telephone(){
		return $this->hasMany('\CustomerTelephone\CustomerTelephone','customer_id','id');
	}

	public function scopeCustomerId($query, $customer_id){
		return $query->where('customer_id', '=', $customer_id);
	}

	public function scopeTagId($query, $tag_id){
		return $query->where('tag_id', '=', $tag_id);
	}

	public function scopeCustomerTag($query){
		return $this->leftJoin('tags',$this->table.'.tag_id','=','tags.id')->select('tag_id as id','tag as text');
	}
	
}
