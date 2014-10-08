<?php
namespace CustomerNotes;
/**
 * main model for Clients
 * */

class CustomerNotes extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_notes';

	protected $fillable = array(
		'customer_id',
		'note',
		'file',
		'added_by',
	);

}
