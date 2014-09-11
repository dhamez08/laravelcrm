<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('company');
			$table->string('email');
			$table->string('sms');
			$table->string('telephone');
			$table->string('address_line');
			$table->string('address_town');
			$table->string('address_county');
			$table->string('address_postcode');
			$table->string('confirm_code');
			$table->tinyInteger('send_task_reminder')->default(0);
			$table->tinyInteger('type')->default(1);
			$table->string('package',5)->default('lite');
			$table->tinyInteger('payment_exempt')->default(0);
			$table->string('theme_site');
			$table->tinyInteger('theme_icons')->default(0);
			$table->tinyInteger('trial')->default(1);
			$table->tinyInteger('admin_account')->default(0);
			$table->tinyInteger('manager_account')->default(0);
			$table->string('files_1')->default('Custom Form Files');
			$table->string('files_2');
			$table->string('files_3');
			$table->string('files_4');
			$table->string('files_5');
			$table->string('files_6');
			$table->tinyInteger('active')->default(0);
			$table->integer('username_update')->default(0);
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->timestamp('confirmed_date');
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
