<?php

class AuthController extends BaseController {
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
		$this->data_view['html_body_class'] = 'login';
		return $this->data_view;
	}

	public function getIndex()
	{
		$data = $this->getSetupThemes();
		return \View::make( $data['view_path'] . '.index.login', $data );
	}

}
