<?php

class LanguagesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		DB::table('languages')->insert(array(
			array('name'=>'English','short'=>'en'),
		));
	}

}
