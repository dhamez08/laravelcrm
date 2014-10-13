<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBuildFieldToCustomFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_custom_forms', function($table) {
		    $table->longText('build')->after('user_id')->nullable();
		    $table->integer('last_field_ctr')->after('build')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_custom_forms', function($table) {
		    $table->dropColumn('build');
		    $table->dropColumn('last_field_ctr');
		});
	}

}
