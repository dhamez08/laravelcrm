<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCustomFormsBuild extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::create('users_custom_forms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->foreign('form_id')->references('id')->on('users_custom_forms')->onDelete('CASCADE')->onUpdate('CASCADE');
			$table->string('label',30);
			$table->integer('type',1);
			$table->string('placeholder',30);
			$table->text('value');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->softDeletes();
		});*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_custom_forms');
	}

}
