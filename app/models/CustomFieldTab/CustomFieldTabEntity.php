<?php
namespace CustomFieldTab;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFieldTabEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_tabs';
	protected static $instance = null;

	protected $dates = ['deleted_at'];

	public function __construct(){
	}

	/**
	 * Return an instance of this class.
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

	public function saveTab($data) {
		$this->name = $data['tab'];
		$this->user_id = \Auth::id();
		$this->save();
	}

	public function getTabsByLoggedUser() {

		$tabs = $this->where('user_id', '=', \Auth::id())
					->whereNull('deleted_at');

		return $tabs->get();

	}

	public function updateCustomTab($data) {
		//section1
		$section1 = $data["section1"];
		$explode1 = explode('_', $section1);
		if ($explode1[0]=="form") {
			$section1 = 3;
			$section1_form = $explode1[1];
		} else {
			$section1 = $explode1[1];
			$section1_form = "";
		}

		//section2
		$section2 = $data["section2"];
		$explode2 = explode('_', $section2);
		if ($explode2[0]=="form") {
			$section2 = 3;
			$section2_form = $explode2[1];
		} else {
			$section2 = $explode2[1];
			$section2_form = "";
		}

		//section3
		$section3 = $data["section3"];
		$explode3 = explode('_', $section3);
		if ($explode3[0]=="form") {
			$section3 = 3;
			$section3_form = $explode3[1];
		} else {
			$section3 = $explode3[1];
			$section3_form = "";
		}

		//section4
		$section4 = $data["section4"];
		$explode4 = explode('_', $section4);
		if ($explode4[0]=="form") {
			$section4 = 3;
			$section4_form = $explode4[1];
		} else {
			$section4 = $explode4[1];
			$section4_form = "";
		}

		//section5
		$section5 = $data["section5"];
		$explode5 = explode('_', $section5);
		if ($explode5[0]=="form") {
			$section5 = 3;
			$section5_form = $explode5[1];
		} else {
			$section5 = $explode5[1];
			$section5_form = "";
		}

		//section6
		$section6 = $data["section6"];
		$explode6 = explode('_', $section6);
		if ($explode6[0]=="form") {
			$section6 = 3;
			$section6_form = $explode6[1];
		} else {
			$section6 = $explode6[1];
			$section6_form = "";
		}

		$this->name 		 = $data["tab_name"];
		$this->section1 	 = $section1;
		$this->section1_form = $section1_form;
		$this->section1_name = $data["section1_name"];
		$this->section2 	 = $section2;
		$this->section2_form = $section2_form;
		$this->section2_name = $data["section2_name"];
		$this->section3 	 = $section3;
		$this->section3_form = $section3_form;
		$this->section3_name = $data["section3_name"];
		$this->section4 	 = $section4;
		$this->section4_form = $section4_form;
		$this->section4_name = $data["section4_name"];
		$this->section5 	 = $section5;
		$this->section5_form = $section5_form;
		$this->section5_name = $data["section5_name"];
		$this->section6 	 = $section6;
		$this->section6_form = $section6_form;
		$this->section6_name = $data["section6_name"];

		return $this->save() ? 1:0;
	}

}
