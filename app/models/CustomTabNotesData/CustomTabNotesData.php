<?php
namespace CustomTabNotesData;
class CustomTabNotesData extends \Eloquent{
	protected $table = 'users_custom_tabs_notes_data';

	protected $fillable = array('customer_id', 'custom_id', 'section', 'entry');
}
