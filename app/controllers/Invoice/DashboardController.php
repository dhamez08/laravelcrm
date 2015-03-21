<?php
namespace Invoice;

use Invoice\Invoice;
use Invoice\Report;
use Invoice\UserSetting;
use Clients\Clients as Client;
use Invoice\Product;
use View;
use Auth;


class DashboardController extends \BaseController {

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
	
	
	public function index()
	{
		if (Auth::user()->role_id != 3)
		{
			$invoice = new Invoice;
			$reports = new Report;
			$check	 = new UserSetting;
			$invoice->invoiceStatus();
			
			$data = array(
				'clients'			=> Client::where('belongs_user', Auth::id())->count(),
				'products'			=> Product::where('user_id', Auth::id())->where('status', 1)->count(),
				'invoices'			=> Invoice::where('user_id', Auth::id())->count(),
				'totalAmount'		=> Invoice::where('user_id', Auth::id())->where('status_id', 1)->sum('amount'),
				'invoiceChart'		=> $invoice->invoiceChart(),
				'reports'			=> $reports->invoices(),
				'lastInvoices'		=> $invoice->lastUnpaidInvoices(),
				'overdueInvoices'	=> $invoice->overdueInvoices(),
				'check'				=> $check->checkSettings()
			);		

			$data += $this->getSetupThemes();

			return View::make($data['view_path'] . '.invoice.dashboard.index', $data);
		}		
		else
		{
			$invoices	= new Invoice;
			$client 	= Client::where('email', Auth::user()->email)->first();	
		
			$data = array(
				'invoices'			=> $invoices->invoicesReceived(),
				'totalAmount'		=> isset($client->id) ? Invoice::where('client_id', $client->id )->sum('amount') : 0,
				'invoicesReceived'	=> $invoices->invoicesReceived()
			);	

			$data += $this->getSetupThemes();		
		
			return View::make($data['view_path'] . '.invoice.dashboard.client', $data);
		}
	}

}