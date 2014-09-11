<?php
/**
 * This is for the dashboard controller
 * @author APYC
 * */
namespace Dashboard;

class DashboardController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $data_view;

	public function __construct(){
		parent::__construct();
		$this->data_view = parent::setupThemes();
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

	public function getSetupThemes(){
		var_dump($this->data_view);
	}

	public function getIndex(){
		$data = $this->data_view;
		return \View::make( $data['view_path'] . '.dashboard.index', $data );
	}

	public function displayContent(){
		$data = $this->data_view;
		return \View::make( $data['view_path'] . '.dashboard.partials.content', $data );
	}

}
