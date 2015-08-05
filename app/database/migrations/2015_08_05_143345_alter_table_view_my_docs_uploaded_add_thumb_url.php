<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableViewMyDocsUploadedAddThumbUrl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('view_my_docs_uploaded', function($table)
        {
            $table->text('thumb_url')->after('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('view_my_docs_uploaded', function(Blueprint $table)
        {
            $table->dropColumn('thumb_url');
        });
    }

}
