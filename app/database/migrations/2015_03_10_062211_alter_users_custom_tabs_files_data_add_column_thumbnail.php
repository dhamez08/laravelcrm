<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersCustomTabsFilesDataAddColumnThumbnail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//users_custom_tabs_files_data
		Schema::table('users_custom_tabs_files_data', function($table) 
		{
			$table->string('thumbnail');
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
