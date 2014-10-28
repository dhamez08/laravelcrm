<?php
namespace MessageAttachment;

class MessageAttachment extends \Eloquent{

	protected $table = 'messages_attachments';

	protected $fillable = array(
		'message_id',
		'file'
	);
}
