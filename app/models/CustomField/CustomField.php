<?php
namespace CustomField;
class CustomField extends \Eloquent{
	protected $table = 'users_custom_fields';

	public function user() {
		return $this->belongsTo('\User\User','user_id','id')->whereNull('deleted_at');
	}
}
