<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersCustomFormsBuildTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_custom_forms_build', function($table) {
		    $table->dropColumn('order_number');
		    $table->dropColumn('label');
		    $table->dropColumn('type');
		    $table->dropColumn('placeholder');
		    $table->dropColumn('value');
		    $table->string('field_name',50)->after('form_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_custom_forms_build', function($table) {
		    $table->integer('order_number')->after('form_id');
		    $table->string('label',30)->after('order_number');
		    $table->integer('type')->after('label');
		    $table->string('placeholder')->after('type');
		    $table->text('value')->after('placeholder');
		    $table->dropColumn('field_name');
		});
	}

}
