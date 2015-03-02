<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTablesFamily extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('activity', function($table) {
            $table->increments('id');
            $table->integer('belongs_to')->index();
            $table->integer('belongs_user')->index();
            $table->dateTime('date_added');
            $table->integer('activity_type_id')->index();
            $table->integer('object_id')->index();
        });
        
        Schema::create('activity_type', function($table) {
            $table->increments('id');
            $table->integer('activity_group_id')->index();
            $table->string('name', 150)->nullable();
            $table->text('log_text')->nullable();
        });        

        Schema::create('activity_group', function($table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_added');
        }); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity');
		Schema::drop('activity_type');
		Schema::drop('activity_group');
	}

}
