<?php

class InvoiceStatusesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		DB::table('invoice_statuses')->insert(array(
			array('name'=>'paid'),
			array('name'=>'unpaid'),
			array('name'=>'partially paid'),
			array('name'=>'cancelled'),
			array('name'=>'overdue'),
		));
	}

}
