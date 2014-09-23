<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersCustomFormsBuild extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_custom_forms_build', function($table)
		{
		    $table->integer('order_number')->after('form_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_custom_forms_build', function($table)
		{
		    $table->dropColumn('order_number');
		});
	}

}
