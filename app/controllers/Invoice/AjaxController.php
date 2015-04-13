<?php
namespace Invoice;

use Invoice\Product;
use Input;
use Auth;
use Response;

class AjaxController extends \BaseController {
	
	
	public function productPrice()
	{
		//return json_encode( Product::where('id', Input::get('product'))->where('user_id', Auth::id())->first() );
		return Response::json( Product::where('id', Input::get('product'))->where('user_id', Auth::id())->first() );
	}
	
}