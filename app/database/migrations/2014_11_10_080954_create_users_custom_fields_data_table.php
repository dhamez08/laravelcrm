<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCustomFieldsDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users_custom_fields_data', function($table) {
            $table->increments('id');
            $table->integer('field_id');
            $table->integer('customer_id');
            $table->string('value');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_custom_fields_data');
	}

}
