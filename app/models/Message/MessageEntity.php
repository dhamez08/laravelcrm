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

	/**
	 * This is use to create user or update
	 * this is full field, mainly use in register
	 *
	 * @param 	$id		int		default null		if there is id then update, else create
	 * @param	$active	int		default 2			#2 means not active
	 * 												#1 would be active
	 * @return db last insert id
	 * */
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \Message\Message;
		}else{
			//update
			$obj = \Message\Message::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}

	public function listAllMessages() {
		$rows = array();
		$sql = "SELECT m.id, m.sender, m.to, m.subject, m.body, m.added_date, m.read_status, m.direction, c.belongs_to, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client, c.id as clientid FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction='2' AND m.deleted_at IS NULL ORDER BY m.read_status, m.added_date DESC";
		$query = \DB::select($sql, array(\Session::get('group_id')));

		return $query;
	}

	public function listAllUnreadMessages() {
		$rows = array();
		$sql = "SELECT m.id, m.sender, m.to, m.subject, m.body, m.added_date, m.read_status, m.direction, c.belongs_to, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client, c.id as clientid FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction='2' AND m.deleted_at IS NULL AND m.read_status = '0' ORDER BY m.read_status, m.added_date DESC";
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

	public function getMessageDetails($id) {
		$sql = "SELECT c.*,m.*, m.added_date as messagedate FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_user=? AND m.id=? LIMIT 1";
		$query = \DB::select($sql, array(\Auth::id(), $id));

		return $query;
	}

	public function summaryRecentMessages($id) {
		$sql = "SELECT * FROM messages WHERE customer_id=? AND type='0' AND (direction='1' OR direction='2') AND deleted_at IS NULL ORDER BY added_date DESC LIMIT 4";
		$query = \DB::select($sql, array($id));

		return $query;
	}

	public function getFormDataByFormNameAndFieldNameAndCustomer($form_name, $field_name, $customer_id) {
		$sql="SELECT f.name, fd.* FROM users_custom_forms f, users_custom_forms_data fd WHERE f.id=fd.form_id AND f.name=? AND fd.customer_id=? AND fd.field_name=?";
		$query = \DB::select($sql, array($form_name, $customer_id, $field_name));

		return $query;
	}

	public function getCustomerMessages($id) {
		$sql = "SELECT * FROM messages WHERE customer_id=? AND (direction='1' OR direction='2') AND deleted_at IS NULL ORDER BY added_date DESC";
		$query = \DB::select($sql, array($id));

		return $query;
	}

	public function attachments() {
		return $this->hasMany('\MessageAttachment\MessageAttachmentEntity','message_id');
	}

	public function force_delete($mid) {
		$sql = "DELETE FROM messages WHERE id=?";
		$query = \DB::statement($sql, array($mid));

	}

    public function listAllSentMessagesWithFilter($filter, $page_size, $page_ndx) {
        $rows = array();
        $sql = "SELECT m.sender, m.to, m.subject, m.added_date, m.read_status, CONCAT(c.company_name, ' ', c.first_name, ' ', c.last_name) as client FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.read_status=? AND m.direction='1' AND m.deleted_at IS NULL ORDER BY m.read_status,m.added_date DESC LIMIT ? OFFSET ?";
        $query = \DB::select($sql, array(\Session::get('group_id'), $filter, $page_size, $page_ndx));

        return $query;
    }

    public function countAllMessages($start_date, $end_date){
        $rows = array();
        $sql = "SELECT m.read_status, count(m.read_status) as message_count FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction='1' AND m.deleted_at IS NULL AND m.created_at BETWEEN ? AND ? GROUP BY m.read_status";
        $query = \DB::select($sql, array(\Session::get('group_id'), $start_date." 00:00:00", $end_date." 23:59:59"));

        return $query;
    }

    public function countSentMessagesPerDay($start_date, $end_date){
        $dates = array();
        $sql = 'SELECT DATE_FORMAT(m.created_at, "%d") as date, count(m.created_at) as email_count FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction="1" AND m.deleted_at IS NULL AND m.created_at BETWEEN ? AND ? AND (m.read_status = 1 OR m.read_status = 0) GROUP BY DATE_FORMAT(m.created_at, "%Y%m%d")';
        $query = \DB::select($sql, array(\Session::get('group_id'), $start_date." 00:00:00", $end_date." 23:59:59"));
        foreach($query as $result){
            $dates[intval($result->date)] = intval($result->email_count);
        }

        $date_range = $this->createDateRangeArray($start_date, $end_date);
        $date_count = array();
        foreach($date_range as $date){
            if(isset($dates[intval($date)])){
                $date_count[intval($date)] = $dates[intval($date)];
            } else {
                $date_count[intval($date)] = 0;
            }
        }

        return $date_count;
    }

    public function countReadMessagesPerDay($start_date, $end_date){
        $dates = array();
        $sql = 'SELECT DATE_FORMAT(m.created_at, "%d") as date, count(m.created_at) as email_count FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction="1" AND m.deleted_at IS NULL AND m.created_at BETWEEN ? AND ? AND m.read_status = 1 GROUP BY DATE_FORMAT(m.created_at, "%Y%m%d")';
        $query = \DB::select($sql, array(\Session::get('group_id'), $start_date." 00:00:00", $end_date." 23:59:59"));
        foreach($query as $result){
            $dates[intval($result->date)] = intval($result->email_count);
        }

        $date_range = $this->createDateRangeArray($start_date, $end_date);
        $date_count = array();
        foreach($date_range as $date){
            if(isset($dates[intval($date)])){
                $date_count[intval($date)] = $dates[intval($date)];
            } else {
                $date_count[intval($date)] = 0;
            }
        }

        return $date_count;
    }

    public function countBouncedMessagesPerDay($start_date, $end_date){
        $dates = array();
        $sql = 'SELECT DATE_FORMAT(m.created_at, "%d") as date, count(m.created_at) as email_count FROM messages m, customer c WHERE m.customer_id=c.id AND c.belongs_to=? AND m.direction="1" AND m.deleted_at IS NULL AND m.created_at BETWEEN ? AND ? AND m.read_status = -1 GROUP BY DATE_FORMAT(m.created_at, "%Y%m%d")';
        $query = \DB::select($sql, array(\Session::get('group_id'), $start_date." 00:00:00", $end_date." 23:59:59"));
        foreach($query as $result){
            $dates[intval($result->date)] = intval($result->email_count);
        }

        $date_range = $this->createDateRangeArray($start_date, $end_date);
        $date_count = array();
        foreach($date_range as $date){
            if(isset($dates[intval($date)])){
                $date_count[intval($date)] = $dates[intval($date)];
            } else {
                $date_count[intval($date)] = 0;
            }
        }

        return $date_count;
    }

    private function createDateRangeArray($strDateFrom,$strDateTo){
        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('d',$iDateFrom));
            }
        }
        return $aryRange;
    }
}
