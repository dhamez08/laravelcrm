<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsPurchaseHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('sms_purchase_history', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('sms_username');
			$table->integer('credits');
			$table->string('sms_ref');
			$table->string('paypal_token');
			$table->decimal('price',10,2);
			$table->integer('status');
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
