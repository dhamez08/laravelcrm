<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomTasksTableAddNoteType extends Migration {

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
			$table->string('note_type', 20)->nullable()->default('note_custom');
			$table->index('note_type');
			$table->text('custom_note')->nullable()->default(null);
			$table->string('custom_note_file')->nullable()->default(null);
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
		    $table->dropColumn('note_type');
		    $table->dropColumn('custom_note');
		    $table->dropColumn('custom_note_file');
		});			
	}

}
