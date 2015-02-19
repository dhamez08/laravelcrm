<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSystemLayoutSection extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('system_layout_section', function($table) {
            $table->increments('id');
            $table->integer('layout_id');
            $table->integer('group_id');
            $table->string('name');
            $table->string('display_image');
            $table->text('source_code');
            $table->softDeletes();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('system_layout_section');
	}

}
