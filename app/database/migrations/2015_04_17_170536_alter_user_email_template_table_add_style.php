<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserEmailTemplateTableAddStyle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('user_email_template', function($table)
        {
            $table->text('style')->after('source_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_email_template', function($table)
        {
            $table->dropColumn('style');
        });
    }

}
