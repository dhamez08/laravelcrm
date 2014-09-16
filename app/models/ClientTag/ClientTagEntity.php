<?php
namespace ClientTag;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class ClientTagEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'tags';
	protected static $instance = null;

	protected $dates = ['deleted_at'];

	protected $fillable = array('tag', 'belongs_to');

	public function __construct(){
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function saveTag($data) {

		$this->tag = $data['tag'];
		$this->belongs_to = \Auth::id();
		$this->save();

	}

	public function getTagsByLoggedUser() {

		$tags = $this->where('belongs_to', '=', \Auth::id())
					->whereNull('deleted_at');

		return $tags->get();

	}
}
