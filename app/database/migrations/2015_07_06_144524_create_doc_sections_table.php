<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doc_sections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id');
			$table->string('description');
			$table->integer('parent_id')->default(0); //0-section , x-subsection
			$table->integer('status_id')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('doc_sections');
	}

}
