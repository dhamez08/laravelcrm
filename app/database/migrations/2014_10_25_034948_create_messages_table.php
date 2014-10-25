<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function($table) {
			$table->increments('id');
			$table->dateTime('added_date');
			$table->integer('customer_id');
			$table->string('sender');
			$table->string('to');
			$table->string('subject',150);
			$table->text('body');
			$table->text('data');
			$table->boolean('type')->default(0);
			$table->boolean('direction')->default(0);
			$table->boolean('method')->default(1);
			$table->string('ref',20);
			$table->boolean('read_status')->default(0);
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
		Schema::drop('messages');
	}

}
