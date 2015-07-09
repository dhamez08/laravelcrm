<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDocumentLibraryOwnAddThumbnail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('document_library_own', function(Blueprint $table)
        {
            $table->text('thumbnail');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('document_library_own', function(Blueprint $table)
        {
            $table->dropColumn('thumbnail');
        });
	}

}
