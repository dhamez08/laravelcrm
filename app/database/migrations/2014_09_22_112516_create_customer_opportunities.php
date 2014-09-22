<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOpportunities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_opportunities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id');
			$table->integer('belongs_to');
			$table->integer('belongs_user');
			$table->string('milestone');
			$table->integer('probability');
			$table->decimal('value',10,2);
			$table->decimal('value_calc',10,2);
			$table->date('close_date');
			$table->string('name');
			$table->text('text');
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
