<?php
namespace CustomTab;

class CustomTabController extends \BaseController {

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

	public function postAddNote() {
		$notesObj = new \CustomTabNotesData\CustomTabNotesData;

		if($notesObj->create(\Input::all())) {
			\Session::flash('message', 'Successfully Added!');
			return \Redirect::to('clients/custom/'.\Input::get('customer_id').'?custom='.\Input::get('custom_id'));
		} else {
			return \Redirect::to('clients/custom/'.\Input::get('customer_id').'?custom='.\Input::get('custom_id'))
					->withErrors(['There was a problem, please try again']);
		}
	}

	public function postAddFile() {

	}

}
