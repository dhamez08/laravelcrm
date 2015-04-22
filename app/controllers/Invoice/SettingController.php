<?php
namespace Invoice;

use Invoice\UserSetting;
use Invoice\Image;
use Invoice\Tax;
use Invoice\InvoiceSetting;
use Invoice\InvoiceStatus;
use Invoice\Currency;
use Invoice\Payment;
use Invoice\General;
use Invoice\Language;
use Invoice\Newsletter;
use View;
use Input;
use Redirect;
use Validator;
use Session;
use Auth;

class SettingController extends \BaseController {

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

		\Debugbar::info(\Session::all());

		if( ! \Session::has('invoice_setting_active_tab')) {
			\Session::put('invoice_setting_active_tab', 1);
		}

		$settings = new UserSetting;
		
		$data = array(
			'company' 			=> UserSetting::where('user_id', Auth::id())->first(),
			'logo'				=> Image::where('user_id', Auth::id())->first(),
			'taxes' 			=> Tax::where('user_id', Auth::id())->get(),
			'invoiceSettings'	=> InvoiceSetting::where('user_id', Auth::id())->first(),
			'invoiceStatus'		=> InvoiceStatus::all(),
			'currencies'		=> Currency::where('user_id', Auth::id())->get(),
			'payments'			=> Payment::where('user_id', Auth::id())->get(),		
			'app'				=> General::find(1)->first(),
			'languages'			=> Language::all(),
			'defaultLanguage'	=> $settings->defaultLanguage(),
			'newsletter'		=> Newsletter::where('user_id', Auth::id())->first()
		);	

		$data += $this->getSetupThemes();	
	
		if ( Auth::user()->role_id == 1 )
		{
			return View::make($data['view_path'] .  '.invoice.settings.admin', $data);
		}	
		else
		{
			return View::make($data['view_path'] .  '.invoice.settings.index', $data);
		}
	}

	
	/* === C.R.U.D. === */
	public function update($id)
	{
		$rules = array(
			'name'     	=> 'required',
			'country'	=> 'required',
			'state'		=> 'required',
			'city'		=> 'required',
			'zip'		=> 'required',
			'address'	=> 'required',
			'contact'	=> 'required',
			'phone'		=> 'required',
			'email'		=> 'required|email',
			'website'	=> 'url',
		);	
		
		$validator = Validator::make(Input::all(), $rules);		
		
		if ($validator->passes())
		{		
			$update					= UserSetting::where('user_id', Auth::id())->first();
			$update->name			= Input::get('name');
			$update->country		= Input::get('country');
			$update->state			= Input::get('state');
			$update->city			= Input::get('city');
			$update->zip			= Input::get('zip');
			$update->address		= Input::get('address');
			$update->contact		= Input::get('contact');
			$update->phone			= Input::get('phone');
			$update->email			= Input::get('email');
			$update->website		= Input::get('website');
			$update->bank			= Input::get('bank');
			$update->bank_account	= Input::get('bank_account');			
			$update->description	= Input::get('description');			
			$update->status			= 1;
			$update->save();
		}
		else
		{
			return Redirect::to('invoice/setting')->with('message', trans('invoice.validation_error_messages'))->withErrors($validator)->withInput();
		}	
		
		return Redirect::to('invoice/setting')->with('message', trans('invoice.data_was_updated'));
	}
	/* === END C.R.U.D. === */	
	
	
	/* === OTHERS === */
	public function defaultLanguage()
	{
		$rules = array(
			'language'	=> 'required',
		);	
		
		$validator = Validator::make(Input::all(), $rules);		
		
		if ($validator->passes())
		{		
			$update					= UserSetting::where('user_id', Auth::id())->first();
			$update->language_id	= Input::get('language');
			$update->save();		
		}
		else
		{
			return Redirect::to('invoice/setting')->with('message', trans('invoice.validation_error_messages'))->withErrors($validator)->withInput();
		}			
		
		return Redirect::to('invoice/setting')->with('message', trans('invoice.data_was_updated'));
	}
	/* === END OTHERS === */
	
	
	/* === AJAX === */
	public function defaultCurrency()
	{
		$update					= UserSetting::where('user_id', Auth::id())->first();
		$update->currency_id	= Input::get('itemID');
		$update->save();
		
		$data = array(
			'company' 		=> UserSetting::where('user_id', Auth::id())->first(),
			'currencies'	=> Currency::all(),
		);	

		$data += $this->getSetupThemes();	
	
		Session::flash('ajaxMessage', trans('invoice.data_was_updated'));	
		
		return View::make($data['view_path'] .  '.invoice.settings.currency', $data);	
	}

	public function changeActiveTab()
	{
		$tab = \Input::get('tabNumber');
		\Session::put('invoice_setting_active_tab', $tab);

		$result = array('result' => \Session::get('invoice_setting_active_tab'));

		return \Response::json($result);
	}
	/* === END AJAX === */
	
}