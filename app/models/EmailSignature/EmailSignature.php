<?php
namespace EmailSignature;

class EmailSignature extends \Eloquent{

	protected $table = 'email_signatures';

	public function user()
	{
		return $this->belongsTo('\User\User', 'id', 'belongs_to');
	}

}
