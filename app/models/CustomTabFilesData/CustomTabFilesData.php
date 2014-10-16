<?php
namespace CustomTabFilesData;
class CustomTabFilesData extends \Eloquent{
	protected $table = 'users_custom_tabs_files_data';

	protected $fillable = array('customer_id', 'custom_id', 'section', 'name', 'file_name', 'file_type');
}
