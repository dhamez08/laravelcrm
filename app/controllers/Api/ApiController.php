<?php
namespace Api;
use Carbon\Carbon;
class ApiController extends \Controller{
	
	public function postVmdShared() {
		$new_file = array(
			'ref' => \Input::get('ref'),
			'url' => \Input::get('url'),
            'thumb_url' => \Input::get('thumb'),
			'name' => \Input::get('name'),
			'notes' => \Input::get('notes'),
			'time' => \Input::get('time'),
			'provider' => \Input::get('provider')			
		);
		\DB::table('view_my_docs_uploaded')->insert($new_file);
	}

}