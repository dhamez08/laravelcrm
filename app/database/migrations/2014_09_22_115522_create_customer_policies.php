<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPolicies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_policies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id');
			$table->string('policy',20);
			$table->string('start_date',10);
			$table->string('renewal_date',10);
			$table->string('insurer',100);
			$table->string('product',100);
			$table->string('indemnity',10);
			$table->string('type',15);
			$table->string('term',10);
			$table->string('benefit',10);
			$table->decimal('premium',10,2);
			$table->string('collected',10);
			$table->string('file');
			$table->tinyInteger('status');
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
