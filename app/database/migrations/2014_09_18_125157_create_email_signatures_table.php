<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSignaturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_signatures', function(Blueprint $table)
		{
			/*
			+------------+--------------+------+-----+---------+----------------+
			| Field      | Type         | Null | Key | Default | Extra          |
			+------------+--------------+------+-----+---------+----------------+
			| id         | int(10)      | NO   | PRI | NULL    | auto_increment |
			| belongs_to | int(10)      | NO   |     | NULL    |                |
			| name       | varchar(100) | NO   |     | NULL    |                |
			| body       | text         | NO   |     | NULL    |                |
			+------------+--------------+------+-----+---------+----------------+
			*/

			$table->increments('id');
			$table->integer('belongs_to');
			$table->string('name', 100);
			$table->longText('body');
			$table->timestamps();
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
