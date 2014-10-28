<?php
namespace MessageAttachment;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class MessageAttachmentEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'messages_attachments';
	
	protected static $instance = null;

	protected $dates = ['deleted_at'];

	protected $fillable = array(
		'message_id',
		'file'
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
