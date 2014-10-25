<?php
namespace Message;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class MessageEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'messages';
	
	protected static $instance = null;

	//protected $dates = ['deleted_at'];

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
		'read_status'
	);

	public function __construct()
	{
	
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() 
	{
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}


}
