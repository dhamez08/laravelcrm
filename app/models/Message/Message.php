<?php
namespace Message;

class Message extends \Eloquent{

	protected $table = 'messages';

	protected $fillable = array(
		'added_date',
		'customer_id',
		'sender',
		'to',
		'subject',
		'body',
		'data',
		'type',
		'direction',
		'method',
		'ref',
		'read_status',
		'receipt'
	);

	public function sms(){
		return $this->hasOne('\SMSSent\SMSSent');
	}
}
