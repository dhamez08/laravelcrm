<?php

class GeneralsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		DB::table('generals')->insert(array(
			array('type'=>'2','version'=>'1.1'),
		));
	}

}
