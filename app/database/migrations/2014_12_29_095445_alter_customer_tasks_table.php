<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('customer_tasks', function($table)
		{
			$table->integer('note_id')->after('customer_id')->nullable()->default(null);
			$table->index('note_id');
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
		Schema::table('customer_tasks', function($table)
		{
		    $table->dropColumn('note_id');
		});			
	}

}
