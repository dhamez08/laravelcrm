<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTabTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_tabs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
			$table->tinyInteger('files_tab');
			$table->tinyInteger('messages_tab');
			$table->tinyInteger('pmi_tab');
			$table->tinyInteger('protection_tab');
			$table->tinyInteger('policies_tab');
			$table->tinyInteger('people_tab');
			$table->tinyInteger('opportunities_tab');
			$table->tinyInteger('medical_tab');
			$table->tinyInteger('income_tab');
			$table->tinyInteger('factfind_tab');
			$table->tinyInteger('compliance_tab');
			$table->tinyInteger('live_tab');
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
		Schema::drop('users_tabs');
	}

}
