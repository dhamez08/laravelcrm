<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCustomTabs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_custom_tabs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
			$table->string('name',25);
			$table->string('section1',20);
			$table->string('section1_name',50);
			$table->integer('section1_form');
			$table->string('section2',20);
			$table->string('section2_name',50);
			$table->integer('section2_form');
			$table->string('section3',20);
			$table->string('section3_name',50);
			$table->integer('section3_form');
			$table->string('section4',20);
			$table->string('section4_name',50);
			$table->integer('section4_form');
			$table->string('section5',20);
			$table->string('section5_name',50);
			$table->integer('section5_form');
			$table->string('section6',20);
			$table->string('section6_name',50);
			$table->integer('section6_form');
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
		Schema::drop('users_custom_tabs');
	}

}
