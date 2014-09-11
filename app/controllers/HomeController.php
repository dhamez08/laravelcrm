<?php

class HomeController extends BaseController {


	public function getIndex()
	{
		if( ! \Auth::check() ){
			return $this->redirectLogin();
		}
	}

	private function redirectLogin(){
		return \Redirect::to('login');
	}

}
