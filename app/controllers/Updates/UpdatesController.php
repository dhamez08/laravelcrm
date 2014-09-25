<?php
namespace Updates;
/**
 * Clients Controller
 *
 * */

class UpdatesController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * hold the view essentials like
	 * - title
	 * - view path
	 * @return array | associative
	 * */
	protected $data_view;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		$this->data_view 					= parent::setupThemes();
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
	}

	/**
	 * Return an instance of this class.
	 *
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

	/**
	 * I call this postUpdateWrapper cause it is call in another controller
	 * the $data is for \Input::all()
	 * each $data is defined
	 * */
	public function postUpdateWrapper(
		$belongs_to,
		$belongs_user,
		$customer_id,
		$user,
		$title,
		$type = 1
	){
		\Input::merge(
			array(
				'belongs_to'=>$belongs_to,
				'belongs_user'=>$belongs_user,
				'customer_id'=>$customer_id,
				'user'=>$user,
				'title'=>$title,
				'type'=>$type,
			)
		);
		\Updates\UpdatesEntity::get_instance()->createOrUpdate();
	}

}
