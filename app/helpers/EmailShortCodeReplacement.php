<?php


class EmailShortCodeReplacement {

	protected static $instance = null;

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

	public function replace($custObj, $body) {
		// array('field_name'=>'ReferenceNo'),
		// array('field_name'=>'Title'),
		// array('field_name'=>'Firstname'),
		// array('field_name'=>'Lastname'),
		// array('field_name'=>'Email:Home'),
		// array('field_name'=>'Email:Work'),
		// array('field_name'=>'Gender'),
		// array('field_name'=>'Birthdate'),
		// array('field_name'=>'Marital-Status'),
		// array('field_name'=>'Living-Status'),
		// array('field_name'=>'Employment-Status'),
		// array('field_name'=>'Address:Work:Line1'),
		// array('field_name'=>'Address:Work:HouseNumber'),
		// array('field_name'=>'Address:Work:Postcode'),
		// array('field_name'=>'Address:Work:Town'),
		// array('field_name'=>'Address:Work:County'),
		// array('field_name'=>'Address:Home:Line1'),
		// array('field_name'=>'Address:Home:HouseNumber'),
		// array('field_name'=>'Address:Home:Postcode'),
		// array('field_name'=>'Address:Home:Town'),
		// array('field_name'=>'Address:Home:County'),
		// array('field_name'=>'ContactNumber:Home'),
		// array('field_name'=>'ContactNumber:Work'),
		// array('field_name'=>'ContactNumber:Direct'),
		// array('field_name'=>'ContactNumber:Mobile'),
		// array('field_name'=>'ContactNumber:Fax'),
		// array('field_name'=>'Website:Personal'),
		// array('field_name'=>'Website:Work'),
		// array('field_name'=>'Twitter:Personal'),
		// array('field_name'=>'Twitter:Work'),
		// array('field_name'=>'Skype:Personal'),
		// array('field_name'=>'Skype:Work'),
		// array('field_name'=>'Xing:Personal'),
		// array('field_name'=>'Xing:Work'),
		// array('field_name'=>'Google+:Personal'),
		// array('field_name'=>'Google+:Work'),
		// array('field_name'=>'Facebook:Personal'),
		// array('field_name'=>'Facebook:Work'),
		// array('field_name'=>'YouTube:Personal'),
		// array('field_name'=>'YouTube:Work'),
		// array('field_name'=>'GitHub:Personal'),
		// array('field_name'=>'GitHub:Work'),
		// array('field_name'=>'LinkedIn:Personal'),
		// array('field_name'=>'LinkedIn:Work'),
		// array('field_name'=>'Blog:Personal'),
		// array('field_name'=>'Blog:Work'),

		$data['body'] = $body;

		$data['body'] = str_replace("{ReferenceNo}", $custObj->ref ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Title}", $custObj->title ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Firstname}", $custObj->first_name ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Lastname}", $custObj->last_name ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Gender}", $custObj->gender ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Birthdate}", $custObj->dob ? date("d/m/Y",strtotime($custObj->dob)):"N/A", $data['body']);
		$data['body'] = str_replace("{Marital-Status}", $custObj->marital_status ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Living-Status}", $custObj->living_status ?:"N/A", $data['body']);
		$data['body'] = str_replace("{Employment-Status}", $custObj->employment_status ?:"N/A", $data['body']);

		if($custObj->emails()->count() > 0) {
			$emails = $custObj->emails()->get();
			foreach($emails as $email) {
				$data['body'] = str_replace("{Email:".$email->type."}", $email->email ?:"N/A", $data['body']);
			}
		}
		if($custObj->address()->count() > 0) {
			$addresses = $custObj->address()->get();
			foreach($addresses as $address) {
				$data['body'] = str_replace("{Address:".$address->type.":Line1}", $address->address_line_1 ?:"N/A", $data['body']);
				$data['body'] = str_replace("{Address:".$address->type.":HouseNumber}", $address->address_line_2 ?:"N/A", $data['body']);
				$data['body'] = str_replace("{Address:".$address->type.":Postcode}", $address->postcode ?:"N/A", $data['body']);
				$data['body'] = str_replace("{Address:".$address->type.":Town}", $address->town ?:"N/A", $data['body']);
				$data['body'] = str_replace("{Address:".$address->type.":County}", $address->county ?:"N/A", $data['body']);
			}
		}
		if($custObj->telephone()->count() > 0) {
			$contactnumbers = $custObj->telephone()->get();
			foreach($contactnumbers as $contactno) {
				$data['body'] = str_replace("{ContactNumber:".$contactno->type."}", $contactno->number ?:"N/A", $data['body']);
			}
		}
		if($custObj->url()->count() > 0) {
			$urls = $custObj->url()->get();
			foreach($urls as $url) {
				$data['body'] = str_replace("{".$url->website.":".$url->type."}", $url->url, $data['body']);
			}
		}

		return $data['body'];
	}

}