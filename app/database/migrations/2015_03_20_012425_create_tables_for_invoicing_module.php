<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesForInvoicingModule extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('currencies', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name', 100);
            $table->tinyInteger('position')->unsigned();
        });

        Schema::create('generals', function($table)
        {
            $table->increments('id');
            $table->tinyInteger('type');
            $table->string('version', 10);
        });


		Schema::create('images', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
        });

		Schema::create('invitations', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->tinyInteger('status')->unsigned();
        });

		Schema::create('invoices', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('number')->unsigned();
            $table->double('amount', 10, 2)->unsigned();
            $table->double('discount', 10, 2)->unsigned();
            $table->tinyInteger('type')->unsigned();
            $table->date('start_date');
            $table->date('due_date');
            $table->text('description')->nullable();
            $table->timestamps();
        }); 

		Schema::create('invoice_payments', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->date('payment_date');
            $table->double('payment_amount', 10, 2)->unsigned();
        });

		Schema::create('invoice_products', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->double('price', 10, 2)->unsigned();
            $table->double('tax', 10, 2)->unsigned();
            $table->double('discount', 10, 2)->unsigned()->nullable();
            $table->tinyInteger('discount_type')->unsigned();
            $table->double('discount_value', 10, 2)->unsigned();
            $table->double('amount', 10, 2)->unsigned();
        });        

		Schema::create('invoice_receiveds', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('invoice_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->unsigned();
        });

		Schema::create('invoice_settings', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->integer('number')->unsigned()->nullable();
            $table->string('code', 100)->nullable();
            $table->text('text')->nullable();            
        });

		Schema::create('invoice_statuses', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->string('name', 100);
        });

		Schema::create('languages', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->string('name');
            $table->string('short', 100)->nullable();
        });

		Schema::create('newsletters', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('content');
        });

		Schema::create('payments', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->string('name');
        });

		Schema::create('products', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->text('name');
            $table->string('code');
            $table->double('price', 10, 2)->unsigned();
            $table->text('description');
            $table->tinyInteger('status')->unsigned();
            $table->timestamps();
        });

		Schema::create('taxes', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->double('value', 10, 2)->unsigned();
        });

        Schema::create('user_settings', function($table)
        {
            $table->increments('id')->unsigned();            
            $table->integer('user_id')->unsigned();
            $table->integer('language_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_account')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->unsigned();
        }); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('currencies');
		Schema::drop('generals');
		Schema::drop('images');
		Schema::drop('invitations');
		Schema::drop('invoices');
		Schema::drop('invoice_payments');
		Schema::drop('invoice_products');
		Schema::drop('invoice_receiveds');
		Schema::drop('invoice_settings');
		Schema::drop('invoice_statuses');
		Schema::drop('languages');
		Schema::drop('newsletters');
		Schema::drop('payments');
		Schema::drop('products');
		Schema::drop('taxes');
		Schema::drop('user_settings');
	}

}
