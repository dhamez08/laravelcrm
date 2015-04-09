<?php
namespace Invoice;

use Invoice\Currency;
use Auth;
use Input;
use Redirect;
use Invoice\UserSetting;
use Session;
use View;


class CurrencyController extends \BaseController {

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
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$store				= new Currency;
		$store->user_id		= Auth::id();
		$store->name		= Input::get('value');
		$store->position	= 1;
		$store->save();	

		return Redirect::to('invoice/setting')->with('message', trans('invoice.data_was_saved'));
	}
	
	public function update($id)
	{
		$update				= Currency::where('id', $id)->where('user_id', Auth::id())->first();
		$update->name		= Input::get('value');
		$update->save();	

		return Redirect::to('invoice/setting')->with('message', trans('invoice.data_was_updated'));
	}

	public function destroy($id)
	{
		$delete = Currency::where('id', $id)->where('user_id', Auth::id());
		$delete->delete();
		
		return Redirect::to('invoice/setting')->with('message', trans('invoice.data_was_deleted'));		
	}
	/* === END C.R.U.D. === */

	
	/* === AJAX === */
	public function currencyPosition()
	{
		$update				= Currency::where('id', Input::get('itemID'))->where('user_id', Auth::id())->first();
		$update->position	= Input::get('itemValue');
		$update->save();
		
		$data = array(
			'company' 		=> UserSetting::where('user_id', Auth::id())->first(),
			'currencies'	=> Currency::all(),
		);		

		Session::flash('ajaxMessage', trans('invoice.data_was_updated'));	

		$data += $this->getSetupThemes();
		
		return View::make($data['view_path'] . '.invoice.settings.currency', $data);		
	}
	/* === END AJAX === */
}