<?php
namespace CustomerEmail;
/**
 * Clients Controller
 *
 * */

class CustomerEmailController extends \BaseController {

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
	 * I call this postEmailWrapper cause it is call in another controller
	 * the $data is for \Input::all()
	 * each $data is defined
	 * */
	public function postEmailWrapper($clientId, $email, $type, $id = null){
		\Input::merge(
			array(
				'customer_id'=>$clientId,
				'email'=>$email,
				'type'=>$type,
			)
		);
		if( is_null($id) ){
			\CustomerEmail\CustomerEmailEntity::get_instance()->createOrUpdate();
		}else{
			\CustomerEmail\CustomerEmailEntity::get_instance()->createOrUpdate($id);
		}
	}

}
