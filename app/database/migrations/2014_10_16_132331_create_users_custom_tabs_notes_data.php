<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCustomTabsNotesData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_custom_tabs_notes_data', function($table) {
			$table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->integer('custom_id')->unsigned();
			$table->integer('section');
			$table->text('entry');
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
		Schema::drop('users_custom_tabs_notes_data');
	}

}
