<?php
namespace Message;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class MessageEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'messages';
	
	protected static $instance = null;

	protected $dates = ['deleted_at'];

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

	public function listAllMessages() {
		$rows = array();
		$sql = "SELECT m.id, m.sender, m.to, m.subject, m.body, m.added_date, m.read_status, m.direction, c.belongs_to, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client, c.id as clientid FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction='2' AND m.deleted_at IS NULL ORDER BY m.read_status, m.added_date DESC";		
		$query = \DB::select($sql, array(\Session::get('group_id')));

		return $query;
	}

	public function listAllSentMessages() {
		$rows = array();
		$sql = "SELECT m.id, m.sender, m.to, m.subject, m.body, m.added_date, m.read_status, m.direction, c.belongs_to, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client, c.id as clientid FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction='1' AND m.deleted_at IS NULL ORDER BY m.read_status,m.added_date DESC";		
		$query = \DB::select($sql, array(\Session::get('group_id')));

		return $query;
	}

	public function listAllDraftMessages() {
		$rows = array();
		$sql = "SELECT m.id, m.sender, m.to, m.subject, m.body, m.added_date, m.read_status, m.direction, c.belongs_to, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client, c.id as clientid FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction='3' AND m.deleted_at IS NULL ORDER BY m.read_status,m.added_date DESC";		
		$query = \DB::select($sql, array(\Session::get('group_id')));

		return $query;
	}

	public function listAllTrashMessages() {
		$rows = array();
		$sql = "SELECT m.id, m.sender, m.to, m.subject, m.body, m.added_date, m.read_status, m.direction, c.belongs_to, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client, c.id as clientid FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.deleted_at IS NOT NULL ORDER BY m.read_status,m.added_date DESC";		
		$query = \DB::select($sql, array(\Session::get('group_id')));

		return $query;
	}

	public function getUnreadMessagesCount() {
		$sql = "SELECT * FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_user=? AND m.read_status='0' AND direction='2'";
		$query = \DB::select($sql, array(\Auth::id()));
		return count($query);
	}

	function getMessageDetails($id) {
		$sql = "SELECT c.*,m.*, m.added_date as messagedate FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_user=? AND m.id=? LIMIT 1";		
		$query = \DB::select($sql, array(\Auth::id(), $id));

		return $query;
	}

	public function attachments() {
		return $this->hasMany('\MessageAttachment\MessageAttachmentEntity','message_id');
	}
}
