<?php
namespace Clients;
/**
 * Use to import data
 * */
use Carbon\Carbon;
class ImportClient extends \Eloquent{
	protected static $instance = null;

	protected $import_folder;

	public function __construct(){
		$this->import_folder = public_path() . '/import/';
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

	public function getImportFolder(){
		return $this->import_folder;
	}

	public function uploadImportFile($filename){
		$file_name = \Auth::id() . '_' . $filename->getClientOriginalName();
		// upload
		$upload_success = $filename->move($this->getImportFolder(), $file_name);
		if($upload_success ){
			return $file_name;
		}
	}

	public function getImportData($File){
		$csv 		= array();
		$numcols 	= 0;
		$full_path 	= $this->getImportFolder() . $File;
		$openfile 	= fopen($full_path, 'r');
		$row_count 	= 1;
		// open the csv file
		while (($thecsv = fgetcsv($openfile, 4096, ",")) !== FALSE) {
			// number of columns
			$numcols = count($thecsv);

			if ( \Input::has('headers') && ($row_count==2) ) {
				$csv['data'] = $thecsv;
				break;
			} elseif ( (!\Input::has('headers')) && ($row_count==1)) {
				$csv['data'] = $thecsv;
				break;
			}

			$row_count++;
		}
		$csv['numcols'] = $numcols;
		$csv['headers'] = \Input::has('headers');
		$csv['file'] 	= $full_path;
		// close the file
		fclose($openfile);

		return $csv;
	}

	public function processImport(){
		if( \Input::hasFile('importFile') ){
			$filename = $this->uploadImportFile( \Input::file('importFile') );
			$csv = $this->getImportData($filename);
			return $csv;
		}
	}

	public function processImportToDBperson(){
		$file 			= \Input::get('file');
		$column_count 	= (\Input::get('columns')-1);
		$headers 		= \Input::get('headers');
		$csv_column = \Input::get('column');
		if(\Input::has('file')){
			$filename = $file;

			$openfile = fopen($filename, 'r');

			$row_counter = 0;

			while (($thecsv = fgetcsv($openfile, 4096, ",")) !== FALSE) {

				if (($headers==1) && ($row_counter==0)) {
					$row_counter++;
					continue;
				}

				$row_counter++;

				$import_refs = array(
					'ref' => \Auth::id() . time() . rand(1,9),
					'type' => 1,
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
				);

				$import_company_refs = array(
					'ref' => \Auth::id() . time() . rand(1,9),
					'type' => 2,
					'belongs_to' => \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id,
					'belongs_user' => \Auth::id(),
				);

				$import = array();
				$address = array();
				$telephone = array();
				$email = array();
				$company = array();
				$notes = array();
				//start loop
				for ($i = 0; $i <= $column_count; $i++) {

					// do the name details
					if ( ($csv_column[$i]=="title") || 
						 ($csv_column[$i]=="first_name" ) || 
						 ($csv_column[$i]=="last_name") || 
						 ($csv_column[$i]=="job_title") || 
						 ($csv_column[$i]=="dob") && 
						 ($csv_column[$i]=="marital_status") ) 
					{
						$column_name = $csv_column[$i];
						$import[$column_name] = $thecsv[$i];
					}

					// company details
					if ($csv_column[$i]=="company_name") {
						if ($thecsv[$i]!="") {
							$company['company_name'] = $thecsv[$i];
						}
					}

					// home address details
					if ( ($csv_column[$i]=="address_line_1") || 
						 ($csv_column[$i]=="town") || 
						 ($csv_column[$i]=="county") || 
						 ($csv_column[$i]=="postcode") ) 
					{
						$address_column = $csv_column[$i];
						$address[$address_column] = $thecsv[$i];
						if ($csv_column[$i]=="address_line_1") {
							$address['type'] = 'Home';
						} elseif ($csv_column[$i]=="work_address_line_1") {
							$address['type'] = 'Work';
						}
					}

					// telephone details
					if ( ($csv_column[$i]=="telephone") || 
						 ($csv_column[$i]=="work_telephone") || 
						 ($csv_column[$i]=="mobile") ) 
					{
						if ($thecsv[$i]!="") {
							$telephone['number'] = $thecsv[$i];

							if ($csv_column[$i]=="work_telephone") {
								$telephone['type'] = 'Work';
							} elseif ($csv_column[$i]=="mobile") {
								$telephone['type'] = 'Mobile';
							} else {
								$telephone['type'] = 'Home';
							}
						}
					}

					//email addresses
					if ( ($csv_column[$i]=="email") || ($csv_column[$i]=="work_email") ) {
						if ($thecsv[$i]!="") {
							$email['email'] = $thecsv[$i];
						}
					}

					// customer notes
					if ($csv_column[$i]=="notes") {
						if ($thecsv[$i]!="") {
							$notes['note'] = $thecsv[$i];
						}
					}
						
				} // end loop

				if (count($company)>0) {
					$import_array = array_merge($import_company_refs, $company);
					$clientid = \Clients\Clients::create($import_array);
				} else {
					$import_array = array_merge($import_refs, $import);
					$clientid = \Clients\Clients::create($import_array);
				}
				
				if( $clientid->id ){
					$personid = array('customer_id'=>$clientid->id);
					
					// import the address info
					if (count($address)>2) {
						$address_array = array_merge($address, $personid);
						\CustomerAddress\CustomerAddress::create($address_array);
					}	

					// import the telephone info
					if (count($telephone)>0) {
						$telephone_array = array_merge($telephone, $personid);
						\CustomerTelephone\CustomerTelephone::create($telephone_array);
					}

					// import the email addresses
					if (count($email)>0) {
						$email_to = array(
							'customer_id' => $clientid->id,
							'type' => 'Home'
						);
						$email_array = array_merge($email, $email_to);
						\CustomerEmail\CustomerEmail::create($email_array);
					}

					// import customer notes
					if (count($notes)>0) {

						$note_to = array(
							'customer_id' => $clientid->id,
							'added_by' => \Auth::id()
						);
						$notes_array = array_merge($notes, $note_to);
						\CustomerNotes\CustomerNotes::create($notes_array);
					}
					return true;
				}else{
					return false;
				}

			}
		}
	}

}