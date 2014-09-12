<?php

class HomeController extends BaseController {


	public function getIndex()
	{
		if( ! \Auth::check() ){
			return $this->redirectLogin();
		}else{
			return $this->redirectDashboard();
		}
	}

	private function redirectLogin(){
		return \Redirect::to('login');
	}

	private function redirectDashboard(){
		return \Redirect::to('dashboard');
	}

}
