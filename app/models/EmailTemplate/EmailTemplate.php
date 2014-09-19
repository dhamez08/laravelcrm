<?php
namespace EmailTemplate;

class EmailTemplate extends \Eloquent {
	
	protected $table = 'email_templates';

	public function user()
	{
		return $this->belongsTo('\User\User', 'id', 'belongs_to');
	}

}
