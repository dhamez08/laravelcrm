<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_custom_fields', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name');
			$table->string('label');
			$table->string('placeholder');
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
		Schema::drop('users_custom_fields');
	}

}
