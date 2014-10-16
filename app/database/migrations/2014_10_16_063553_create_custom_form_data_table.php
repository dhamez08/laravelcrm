<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFormDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_custom_forms_data', function($table) {
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->integer('customer_id')->unsigned();
			$table->string('field_name');
			$table->string('value');
			$table->string('ref_id');
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
		Schema::drop('users_custom_forms_data');
	}

}
