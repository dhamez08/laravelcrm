<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDocumentLibraryOwnAddSectionId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('document_library_own', function(Blueprint $table)
        {
            $table->integer('section_id');
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
            $table->dropColumn('section_id');
        });
	}

}
