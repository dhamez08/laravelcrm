<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('sms_sent', function($table) {
			$table->increments('id');
			$table->string('textlocal_msg_id');
			$table->string('textlocal_msg_recipient');
			$table->integer('user_id');
			$table->integer('customer_id');
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
