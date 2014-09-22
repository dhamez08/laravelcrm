<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTasks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id');
			$table->integer('belongs_to');
			$table->integer('task_setting');
			$table->text('name');
			$table->dateTime('date');
			$table->string('end_time');
			$table->dateTime('added_date');
			$table->dateTime('completed_date');
			$table->string('added_by');
			$table->string('action',20);
			$table->dateTime('remind');
			$table->tinyInteger('remind_mins');
			$table->tinyInteger('status');
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
