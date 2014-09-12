<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function(Blueprint $table)
		{
			/*
			+------------------------+--------------+------+-----+---------+----------------+
			| Field                  | Type         | Null | Key | Default | Extra          |
			+------------------------+--------------+------+-----+---------+----------------+
			| id                     | int(10)      | NO   | PRI | NULL    | auto_increment |
			| type                   | int(1)       | NO   |     | 1       |                |
			| ref                    | varchar(15)  | NO   |     | NULL    |                |
			| belongs_to             | int(10)      | NO   |     | NULL    |                |
			| belongs_user           | int(10)      | NO   |     | NULL    |                |
			| added_date             | datetime     | NO   |     | NULL    |                |
			| title                  | varchar(10)  | NO   |     | NULL    |                |
			| first_name             | varchar(100) | NO   |     | NULL    |                |
			| last_name              | varchar(100) | NO   |     | NULL    |                |
			| email                  | varchar(255) | NO   |     | NULL    |                |
			| address_id             | int(10)      | NO   |     | NULL    |                |
			| gender                 | varchar(6)   | NO   |     | NULL    |                |
			| dob                    | date         | NO   |     | NULL    |                |
			| smoker                 | int(1)       | NO   |     | 0       |                |
			| marital_status         | varchar(20)  | NO   |     | NULL    |                |
			| living_status          | varchar(30)  | NO   |     | NULL    |                |
			| employment_status      | varchar(30)  | NO   |     | NULL    |                |
			| occupation             | varchar(150) | NO   |     | NULL    |                |
			| telephone_day          | varchar(20)  | NO   |     | NULL    |                |
			| telephone_evening      | varchar(20)  | NO   |     | NULL    |                |
			| telephone_mobile       | varchar(20)  | NO   |     | NULL    |                |
			| partner_title          | varchar(10)  | NO   |     | NULL    |                |
			| partner_first_name     | varchar(200) | NO   |     | NULL    |                |
			| partner_last_name      | varchar(200) | NO   |     | NULL    |                |
			| partner_dob            | varchar(10)  | NO   |     | NULL    |                |
			| partner_gender         | varchar(6)   | NO   |     | NULL    |                |
			| partner_employment     | varchar(20)  | NO   |     | NULL    |                |
			| partner_occupation     | varchar(150) | NO   |     | NULL    |                |
			| company_name           | varchar(200) | NO   |     | NULL    |                |
			| companyreg             | varchar(20)  | NO   |     | NULL    |                |
			| companyemployee        | varchar(20)  | NO   |     | NULL    |                |
			| sector                 | varchar(100) | NO   |     | NULL    |                |
			| background_info        | text         | NO   |     | NULL    |                |
			| job_title              | varchar(100) | NO   |     | NULL    |                |
			| organisation           | varchar(255) | NO   |     | NULL    |                |
			| associated             | int(10)      | NO   |     | NULL    |                |
			| relationship           | varchar(20)  | NO   |     | NULL    |                |
			| profile_image          | int(10)      | NO   |     | NULL    |                |
			| duedil_company_details | text         | NO   |     | NULL    |                |
			| vmd                    | varchar(50)  | NO   |     | NULL    |                |
			| vmd_pin                | varchar(6)   | NO   |     | NULL    |                |
			+------------------------+--------------+------+-----+---------+----------------+
			*/

			$table->increments('id');	 				
			$table->tinyInteger('type'); 				
			$table->string('ref', 15); 					
			$table->integer('belongs_to'); 				
			$table->integer('belongs_user'); 			
			$table->dateTime('added_date'); 			
			$table->string('title', 10); 				
			$table->string('first_name', 100); 			
			$table->string('last_name', 100); 			
			$table->string('email', 255); 				
			$table->integer('address_id'); 				
			$table->string('gender', 6); 				
			$table->date('dob'); 						
			$table->tinyInteger('smoker'); 				
			$table->string('marital_status', 20); 		
			$table->string('living_status', 30); 		
			$table->string('employment_status', 30); 	
			$table->string('occupation', 150); 			
			$table->string('telephone_day', 20); 		
			$table->string('telephone_evening', 20); 	
			$table->string('telephone_mobile', 20); 	
			$table->string('partner_title', 10); 		
			$table->string('partner_first_name', 200); 	
			$table->string('partner_last_name', 200); 	
			$table->string('partner_dob', 10); 			
			$table->string('partner_gender', 6); 		
			$table->string('partner_employment', 20); 	
			$table->string('partner_occupation', 150); 	
			$table->string('company_name', 200);	 	
			$table->string('companyreg', 20); 			
			$table->string('companyemployee', 20); 		
			$table->string('sector', 100); 				
			$table->text('background_info');		 	
			$table->string('job_title', 100);		 	
			$table->string('organisation', 255); 		
			$table->integer('associated'); 				
			$table->string('relationship', 20); 		
			$table->integer('profile_image'); 			
			$table->text('duedil_company_details'); 	
			$table->string('vmd', 50); 					
			$table->string('vmd_pin', 6); 				
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
