<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEmployees extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id');
			$table->string('title');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('dob');
			$table->string('job_title');
			$table->string('address');
			$table->string('town');
			$table->string('county');
			$table->string('postcode');
			$table->string('gender');
			$table->string('smoker');
			$table->date('dob2');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
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
