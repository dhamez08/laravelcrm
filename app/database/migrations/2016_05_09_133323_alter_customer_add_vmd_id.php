<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerAddVmdId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('customer', function($table)
        {
            $table->bigInteger('vmd_id')->after('vmd_pin');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('customer', function($table)
        {
            $table->dropColumn('vmd_id');
        });
	}

}
