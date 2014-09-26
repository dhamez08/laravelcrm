<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtensionToDocumentLibrariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('document_library_own', function($table) {
		    $table->string('file_ext')->after('filename');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('document_library_own', function($table) {
		    $table->dropColumn('file_ext');
		});
	}

}
