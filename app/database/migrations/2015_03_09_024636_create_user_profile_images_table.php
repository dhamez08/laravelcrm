<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_profile_images', function($table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
            $table->string('reference_id');
            $table->string('reference_name');
            $table->text('image_thumbnails');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_profile_images');
	}

}
