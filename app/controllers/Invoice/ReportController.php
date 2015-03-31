<?php
namespace Invoice;

use Invoice\Report;
use View;

class ReportController extends \BaseController {

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
		$this->data_view = parent::setupThemes();
		$this->data_view['dashboard_index'] = $this->data_view['view_path'] . '.dashboard.index';
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
	 * get themes
	 * @return	array
	 * */
	public function getSetupThemes(){
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid page-full-width';
		$this->data_view['header_class'] = 'page-header navbar navbar-fixed-top';
		return $this->data_view;
	}
		
	/* === VIEW === */
	public function index()
	{
		$reports = new Report;	
		
		$data = array(
			'invoices'	=> $reports->invoices(),
			'amounts'	=> $reports->amounts(),
			'clients'	=> $reports->clients()
		);

		$data += $this->getSetupThemes();
		
		return View::make($data['view_path'] . '.invoice.reports.index', $data);
	}
	/* === END VIEW === */

}