<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenceToCustomerProfileImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customer_profile_images', function(Blueprint $table)
		{
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
		Schema::table('customer_profile_images', function(Blueprint $table)
		{
			$table->dropColumn('reference_id');
			$table->dropColumn('reference_name');
			$table->dropColumn('image_thumbnails');
		});
	}

}
