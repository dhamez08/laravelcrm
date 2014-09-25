<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardUpdate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('updates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('belongs_to');
			$table->integer('belongs_user');
			$table->integer('customer_id');
			$table->string('user');
			$table->string('title');
			$table->integer('task_id');
			$table->integer('note_id');
			$table->text('details');
			$table->tinyInteger('type');
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
