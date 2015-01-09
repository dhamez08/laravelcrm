<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerNotesTableAddTaskId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('customer_notes', function($table)
		{
			$table->integer('task_id')->after('customer_id')->nullable()->default(null);
			$table->index('task_id');
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
		Schema::table('customer_notes', function($table)
		{
		    $table->dropColumn('task_id');
		});			
	}

}
