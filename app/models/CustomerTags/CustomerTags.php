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

	public function scopeCustomerId($query, $customer_id){
		return $query->where('customer_id', '=', $customer_id);
	}

	public function scopeTagId($query, $tag_id){
		return $query->where('tag_id', '=', $tag_id);
	}

}
