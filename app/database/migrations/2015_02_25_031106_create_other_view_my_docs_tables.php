<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherViewMyDocsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('view_my_docs_logins', function($table) {
            $table->increments('id');
            $table->integer('user_id');
			$table->dateTime('time');
			$table->string('ip', 20);
        });
        
        Schema::create('view_my_docs_uploaded', function($table) {
            $table->increments('id');
			$table->dateTime('time');
			$table->string('ref');
			$table->string('provider', 50);
			$table->string('name');
			$table->string('url');
			$table->text('notes');
        });        

        Schema::create('view_my_docs_users', function($table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('pin');
            $table->string('ref', 40);
            $table->string('postcode', 8);
            $table->integer('active');
        });        
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('view_my_docs_logins');
        Schema::drop('view_my_docs_uploaded');
        Schema::drop('view_my_docs_users');
	}

}
