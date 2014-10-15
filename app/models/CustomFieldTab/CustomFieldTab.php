<?php
namespace CustomFieldTab;
class CustomFieldTab extends \Eloquent{
	protected $table = 'users_custom_tabs';

	public function user() {
		return $this->belongsTo('\User\User','user_id','id');
	}
}
