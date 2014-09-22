<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_address', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id');
			$table->text('address_line_1');
			$table->string('address_line_2');
			$table->string('town');
			$table->string('county');
			$table->string('postcode',10);
			$table->string('type',15);
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
