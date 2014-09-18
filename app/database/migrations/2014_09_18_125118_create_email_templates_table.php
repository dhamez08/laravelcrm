<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_templates', function(Blueprint $table)
		{
			/*
			+-------------------+--------------+------+-----+---------+----------------+
			| Field             | Type         | Null | Key | Default | Extra          |
			+-------------------+--------------+------+-----+---------+----------------+
			| id                | int(10)      | NO   | PRI | NULL    | auto_increment |
			| belongs_to        | int(10)      | NO   |     | NULL    |                |
			| name              | varchar(100) | NO   |     | NULL    |                |
			| subject           | varchar(100) | NO   |     | NULL    |                |
			| body              | text         | NO   |     | NULL    |                |
			| attachment_1      | varchar(255) | NO   |     | NULL    |                |
			| attachment_1_name | varchar(255) | NO   |     | NULL    |                |
			| attachment_2      | varchar(255) | NO   |     | NULL    |                |
			| attachment_2_name | varchar(255) | NO   |     | NULL    |                |
			| attachment_3      | varchar(255) | NO   |     | NULL    |                |
			| attachment_3_name | varchar(255) | NO   |     | NULL    |                |
			| attachment_4      | varchar(255) | NO   |     | NULL    |                |
			| attachment_4_name | varchar(255) | NO   |     | NULL    |                |
			| attachment_5      | varchar(255) | NO   |     | NULL    |                |
			| attachment_5_name | varchar(255) | NO   |     | NULL    |                |
			+-------------------+--------------+------+-----+---------+----------------+
			*/

			$table->increments('id');
			$table->integer('belongs_to');
			$table->string('name', 100);
			$table->string('subject', 100);
			$table->longText('body');
			$table->timestamps();
			$table->softDeletes();

			/* Created separate table for email template attachments */
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
