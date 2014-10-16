<?php
namespace CustomFormData;
class CustomFormData extends \Eloquent{
	protected $table = 'users_custom_forms_data';

	protected $fillable = array('form_id', 'customer_id', 'field_name', 'value');
}
