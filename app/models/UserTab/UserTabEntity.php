<?php
namespace UserTab;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class UserTabEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_tabs';
	protected static $instance = null;

	protected $dates = ['deleted_at'];

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

	public function saveTab($data) {

		$tab = $this->firstOrNew(['user_id'=>\Auth::id()]);
		$tab->user_id = \Auth::id();
		$tab->files_tab = isset($data['files_tab']) ? $data['files_tab']:0;
		$tab->messages_tab = isset($data['messages_tab']) ? $data['messages_tab']:0;
		$tab->people_tab = isset($data['people_tab']) ? $data['people_tab']:0;
		$tab->opportunities_tab = isset($data['opportunities_tab']) ? $data['opportunities_tab']:0;
		$tab->live_tab = isset($data['live_tab']) ? $data['live_tab']:0;

		return $tab->save() ? 1:0;

	}

	public function user() {
		return $this->belongTo('\User\UserEntity');
	}

}
