<?php
namespace SMSTemplate;

class SMSTemplate extends \Eloquent {
	
	protected $table = 'sms_templates';

	public function user()
	{
		return $this->belongsTo('\User\User', 'id', 'belongs_to');
	}

}