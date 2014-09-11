<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('manager_id');
			$table->string('logo');
			$table->string('vmd_user');
			$table->string('vmd_pass');
			$table->string('sms_username');
			$table->string('sms_hash');
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
