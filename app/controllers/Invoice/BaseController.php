<?php
namespace Invoice;

use Controller;
use View;
use Invoice\InvoiceReceived;
use Auth;


class BaseController extends Controller {

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

	
	public function __construct()
	{
		if (Auth::check())
		{
			View::share('newInvoicesReceived', InvoiceReceived::where('user_id', Auth::id())->where('status', 0)->count());
		}
	}
}