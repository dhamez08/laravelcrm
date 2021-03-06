<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEmailTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_email_template', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->text('source_code');
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
		Schema::drop('user_email_template');
	}

}
