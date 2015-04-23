<?php
/**
 * This is laravel base controller
 * and therefore each page main setup
 * is in this controller.
 *
 * @access public
 * */

use Invoice\InvoiceReceived;
use Invoice\Invoice;
use Clients\Clients as Client;
use Invoice\Product;

class BaseController extends Controller {

	/**
	 * Use to hold the current admin theme folder
	 * @see /Config/crm.php
	 * @var string
	 * */
	protected $admin_theme_folder;
	/**
	 * Use to hold the current admin theme name
	 * @see /Config/crm.php
	 * @var string
	 * */
	protected $admin_theme_name;
	/**
	 * Use to hold the current admin theme path
	 * @see /Config/crm.php
	 * @var string
	 * */
	protected $admin_theme_path;
	/**
	 * currently hold theme setup namely:
	 * - asset_path
	 * @see function setupThemes
	 * - view_path
	 * @see function setupThemes
	 * - master_view
	 * @see function setupThemes
	 * @var array
	 * */
	protected $theme_setup;

	/**
	 * - auto use filter csrf
	 * - initialize admin theme folder
	 * - initialize admin theme path
	 * @return void
	 * */
	public function __construct(){
		$this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
		$this->admin_theme_folder 	= \Config::get('crm.themes.admin.folder');
		$this->admin_theme_path 	= \Config::get('crm.themes.admin.path');

        if( \Auth::check() && !empty(\Auth::user()->timezone) ){
            $this->setTimeZone(\Auth::user()->timezone);
        }else{
            $this->setTimeZone('Asia/Manila');
        }

		if (Auth::check())
		{
			View::share('newInvoicesReceived', InvoiceReceived::where('user_id', Auth::id())->where('status', 0)->count());

			$invoiceTopBarStats = array(
				'clients'			=> Client::where('belongs_user', Auth::id())->count(),
				'products'			=> Product::where('user_id', Auth::id())->where('status', 1)->count(),
				'invoices'			=> Invoice::where('user_id', Auth::id())->count(),
				'totalAmount'		=> Invoice::where('user_id', Auth::id())->where('status_id', 1)->sum('amount'),
			);			

			View::share('invoiceTopBarStats', $invoiceTopBarStats);
		}        

	}

	public function setTimeZone($timeZone = null){
		date_default_timezone_set($timeZone);
		\Config::set('app.timezone',$timeZone);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Use to auto setup themes
	 * @return associative array
	 * */
	public function setupThemes(){
		return $this->theme_setup = array(
			'asset_path' 	=> $this->getAdminAssets(),
			'view_path' 	=> $this->getAdminView(),
			'master_view' 	=> $this->getAdminView() . '.layout'
		);
	}

	/**
	 * Use to get current theme asset
	 * use laravel URL asset helper
	 * @return string | URL::asset()
	 * */
	public function getAdminAssets(){
		return \URL::asset('public/admin/'. $this->admin_theme_folder .'/assets');
	}

	/**
	 * Get the current theme view
	 * @return string
	 **/
	public function getAdminView(){
		return $this->admin_theme_path;
	}

}
