<?php
namespace Invoice;

use Invoice\Currency;
use Invoice\Product;
use Auth;
use View;
use Request;
use Validator;
use Input;

class ProductController extends \BaseController {

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
		$currency = new Currency;	
		
		$data = array(
			'products' 	=> Product::where('user_id', Auth::id())->where('status', 1)->get(),
			'currency'	=> $currency->defaultCurrency()
		);

		$data += $this->getSetupThemes();
	
		return View::make($data['view_path'] . '.invoice.products.index', $data);
	}

	public function create()
	{
		$this->layout->content = View::make('products.create');
	}

	public function show($id)
	{
		return json_encode( Product::where('id',  Request::segment(2))->where('user_id', Auth::id())->first() );
	}	
	
	public function edit($id)
	{
		$data = array(
			'product'	=> Product::where('id', $id)->where('user_id', Auth::id())->first(),
		);
		
		$this->layout->content = View::make('products.edit', $data);
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'name'		=> 'required',
			'code'		=> 'required',
			'price'		=> 'required',
		);	
		
		$validator = Validator::make(Input::all(), $rules);	
		
		if ($validator->passes())
		{
			$store					= new Product;
			$store->user_id			= Auth::id();
			$store->name			= Input::get('name');
			$store->code			= Input::get('code');
			$store->price			= Input::get('price');
			$store->description		= Input::get('description');
			$store->status			= 1;
			$store->save();	
		}
		else
		{
			return Redirect::to('product/create')->with('message', trans('invoice.validation_error_messages'))->withErrors($validator)->withInput();
		}	
		
		return Redirect::to('product')->with('message', trans('invoice.data_was_saved'));
	}
	
	public function update($id)
	{
		$rules = array(
			'name'		=> 'required',
			'code'		=> 'required',
			'price'		=> 'required',
		);		
		
		$validator = Validator::make(Input::all(), $rules);	
		
		if ($validator->passes())
		{
			$update					= Product::where('id', $id)->where('user_id', Auth::id())->first();
			$update->name			= Input::get('name');
			$update->code			= Input::get('code');
			$update->price			= Input::get('price');
			$update->description	= Input::get('description');
			$update->save();	
		}
		else
		{
			return Redirect::to('product/' . $id . '/edit')->with('message', trans('invoice.validation_error_messages'))->withErrors($validator)->withInput();
		}	
		
		return Redirect::to('product')->with('message', trans('invoice.data_was_updated'));
	}

	public function destroy($id)
	{
		$update 			= Product::where('id', $id)->where('user_id', Auth::id())->first();
		$update->status		= 0;
		$update->save();
		
		return Redirect::to('product')->with('message', trans('invoice.data_was_deleted'));		
	}
	/* === END C.R.U.D. === */

}