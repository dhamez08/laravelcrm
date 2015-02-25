<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableViewMyDocsShared extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('view_my_docs_shared', function($table) {
            $table->increments('id');
            $table->integer('user_id');
			$table->dateTime('time');
			$table->string('name');
			$table->text('url');
			$table->string('ref', 50);
			$table->text('notes');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('view_my_docs_shared');
	}

}
