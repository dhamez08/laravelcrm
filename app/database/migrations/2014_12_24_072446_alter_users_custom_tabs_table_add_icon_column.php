<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersCustomTabsTableAddIconColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users_custom_tabs', function($table)
		{
			$table->string('icon')->after('name');
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
		Schema::table('users_custom_tabs', function($table)
		{
		    $table->dropColumn('icon');
		});		
	}

}
