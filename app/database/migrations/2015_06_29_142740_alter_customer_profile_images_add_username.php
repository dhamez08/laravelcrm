<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerProfileImagesAddUsername extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('customer_profile_images', function(Blueprint $table)
        {
            $table->string('reference_username');
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
            $table->dropColumn('reference_username');
        });
	}

}
