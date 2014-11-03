<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsDeliveryReceipt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('sms_delivery_receipt', function($table) {
			$table->increments('id');
			$table->string('textlocal_number');
			$table->string('textlocal_status');
			$table->string('customID');
			$table->timestamp('datetime');
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
