<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSystemLayoutSectionAddIsGeneric extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('system_email_layout', function($table)
        {
            $table->boolean('is_generic')->after('name')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_email_layout', function($table)
        {
            $table->dropColumn('is_generic');
        });
    }

}
